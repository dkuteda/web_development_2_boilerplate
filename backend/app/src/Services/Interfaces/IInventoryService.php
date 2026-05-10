<?php

namespace App\Services\Interfaces;

use App\Models\InventoryItem;

interface IInventoryService
{
    public function getInventoryItems(?string $term = null, ?string $category = null): array;
    public function getInventoryItemById(int $id): ?InventoryItem;
    public function createInventoryItem(InventoryItem $inventoryItem): ?int;
    public function updateInventoryItem(InventoryItem $inventoryItem): bool;
    public function archiveInventoryItem(int $id): bool;
}