<?php

namespace App\Repositories;

use App\Models\MachineryModel;
use App\Enums\MachineryStatus;
use App\Framework\Repository;
use App\Repositories\Interfaces\IMachineryRepository;
use PDO;

class MachineryRepository extends Repository implements IMachineryRepository
{
    // GET ALL
    public function getMachinery(?string $term = null, ?MachineryStatus $status = null): array
    {
        $sql = 'SELECT MachineryId, MachineryName, Description, Status 
                FROM Machinery 
                WHERE Status = "active"';
        
        $conditions = [];
        $params = [];

        if (!empty($term)) {
            $conditions[] = "(MachineryName LIKE :term OR Description LIKE :term)";
            $params['term'] = '%' . $term . '%';
        }
        if ($status) {
            $conditions[] = "Status = :status";
            $params['status'] = $status->value;
        }
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }
        if (!empty($term)) {
            $sql .= " ORDER BY (MachineryName LIKE :term) DESC";
        }
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params); 
            return array_map(fn($row) => MachineryModel::fromDb((array)$row), $stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return [];
        }
    }

    public function getMachineryById(int $id): ?MachineryModel
    {
        $sql = "SELECT MachineryId, MachineryName, Description, Status 
                FROM Machinery 
                WHERE MachineryId = :id LIMIT 1";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result ? MachineryModel::fromDb((array)$result) : null;
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return null;
        }
    }

    public function createMachinery(MachineryModel $machineryModel): ?int
    {
        $sql = "INSERT INTO Machinery (MachineryName, Description, Status) 
                VALUES (:name, :description, :status)";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $this->bindParams($stmt, $machineryModel);
            if ($stmt->execute()) {
                return (int)$this->getConnection()->lastInsertId();
            }
            return null;
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return null;
        }
    }

    public function updateMachinery(MachineryModel $machineryModel): bool
    {
        $sql = "UPDATE Machinery 
                SET MachineryName = :name, Description = :description, Status = :status 
                WHERE MachineryId = :id";
        
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $this->bindParams($stmt, $machineryModel);
            $stmt->bindValue(':id', $machineryModel->MachineryId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function archiveMachinery(int $id): bool
    {
        try {
            $stmt = $this->getConnection()->prepare("UPDATE Machinery SET Status = 'archived' WHERE MachineryId = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    // Other CRUD methods (create, update, delete) would go here
    private function bindParams($stmt, MachineryModel $machineryModel): void
    {
        $stmt->bindValue(':name', $machineryModel->MachineryName, PDO::PARAM_STR);
        $stmt->bindValue(':description', $machineryModel->Description, PDO::PARAM_STR);
        $stmt->bindValue(':status', $machineryModel->Status->value, PDO::PARAM_STR);
    }

}
