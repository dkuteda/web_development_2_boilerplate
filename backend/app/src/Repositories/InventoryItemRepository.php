<?php
namespace App\Repositories;

use App\Framework\Repository;
use App\Models\InventoryItem;
use App\Repositories\Interfaces\IInventoryItemRepository;
use PDO;

class InventoryItemRepository extends Repository implements IInventoryItemRepository
{
    // GET ALL
    public function getInventoryItems(?string $term = null, ?string $category = null): array
    {
        // 1. Base SQL
        $sql = 'SELECT InventoryItemId, InventoryItemName, StockLevel, Description, Category, Status 
                FROM InventoryItem 
                WHERE status = "active"';
        
        $conditions = [];
        $params = [];

        if (!empty($term)) {
            $conditions[] = "(InventoryItemName LIKE :term OR Description LIKE :term OR Category LIKE :term)";
            $params['term'] = '%' . $term . '%';
        }
        if ($category) {
            $conditions[] = "Category = :category";
            $params['category'] = $category;
        }
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }
        // 3. Handle ordering
        if (!empty($term)) {
            $sql .= " ORDER BY (InventoryItemName LIKE :term) DESC";
        }
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params); 
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return [];
        }
    }

    // Other CRUD methods (create, update, delete) would go here
    public function getInventoryItemById(int $id): ?InventoryItem
    {
        $sql = "SELECT InventoryItemId, InventoryItemName, StockLevel, Description, Category, Status 
                FROM InventoryItem 
                WHERE InventoryItemId = :id LIMIT 1";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result ? InventoryItem::fromDb((array)$result) : null;
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Create: Insert a new inventory item
     */
    public function createInventoryItem(InventoryItem $inventoryItem): ?int
    {
        $sql = "INSERT INTO InventoryItem (InventoryItemName, StockLevel, Description, Category, Status) 
                VALUES (:name, :stock, :description, :category, :status)";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $this->bindParams($stmt, $inventoryItem);
            $stmt->execute();
            return $stmt ? (int)$this->getConnection()->lastInsertId() : null;
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Update: Modify an existing item
     */
    public function updateInventoryItem(InventoryItem $inventoryItem): bool
    {
        $sql = "UPDATE InventoryItem 
                SET InventoryItemName = :name, 
                    StockLevel = :stock, 
                    Description = :description, 
                    Category = :category, 
                    Status = :status 
                WHERE InventoryItemId = :id";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $this->bindParams($stmt, $inventoryItem);
            return $stmt->execute(['id' => $inventoryItem->InventoryItemId]);
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    // DELETE: Deactivate an item (soft delete)
    public function archiveInventoryItem(int $id): bool
    {
        try {
            $stmt = $this->getConnection()->prepare("UPDATE InventoryItem SET Status = 'archived' WHERE InventoryItemId = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

        private function bindParams($stmt, InventoryItem $inventoryItem): void
    {
        $stmt->bindValue(':InventoryItemName', $inventoryItem->InventoryItemName, PDO::PARAM_STR);
        $stmt->bindValue(':StockLevel', $inventoryItem->StockLevel, PDO::PARAM_INT);
        $stmt->bindValue(':Description', $inventoryItem->Description, PDO::PARAM_STR);
        $stmt->bindValue(':Category', $inventoryItem->Category->value, PDO::PARAM_STR);
        $stmt->bindValue(':Status', $inventoryItem->Status, PDO::PARAM_STR);
        $stmt->bindValue(':status', $inventoryItem->Status, PDO::PARAM_STR);
    }
}