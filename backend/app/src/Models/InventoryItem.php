<?php
namespace App\Models;

use App\Enums\ShedItemCategory;

class InventoryItem{
    public int $InventoryItemId;
    public string $InventoryItemName;
    public ShedItemCategory $Category;
    public int $StockLevel;
    public string $Description; 
    public string $Status = 'active';

    public static function fromDb(array $data): self
    {
        $inventoryItem = new self();
        $inventoryItem->InventoryItemId = (int)$data['InventoryItemId'];
        $inventoryItem->InventoryItemName = $data['InventoryItemName'];
        $inventoryItem->Description = $data['Description'] ?? '';
        $inventoryItem->Category = ShedItemCategory::from($data['Category']);
        $inventoryItem->Status = $data['Status'] ?? 'active';
        
        return $inventoryItem;
    }
}