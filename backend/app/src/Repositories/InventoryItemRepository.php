<?php
namespace App\Repositories;

use App\Framework\Repository;
use App\Models\InventoryItem;
use App\Repositories\Interfaces\IInventoryItemRepository;

class InventoryItemRepository extends Repository implements IInventoryItemRepository 
{
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
}