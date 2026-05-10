<?php
namespace App\Repositories\Interfaces;

use App\Models\InventoryItem;

interface IInventoryItemRepository
{
    public function getInventoryItems(?string $term = null, ?string $category = null): array;
    public function findById(int $id): ?object;
    public function create(InventoryItem $inventoryItem): ?int;
    public function update(InventoryItem $inventoryItem): bool;
    public function archive(int $id): bool;
}