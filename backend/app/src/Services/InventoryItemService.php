<?php
namespace App\Services;

use App\Models\InventoryItem;
use App\Repositories\Interfaces\IInventoryItemRepository;
use App\Repositories\InventoryItemRepository;
use App\Services\Interfaces\IInventoryService;

class InventoryItemService implements IInventoryService
{
    private IInventoryItemRepository $repository;

    public function __construct()
    {
        $this->repository = new InventoryItemRepository();
    }

    public function getInventoryItems(?string $term = null, ?string $category = null): array
    {
        return $this->repository->getInventoryItems($term, $category);
    }

    public function getInventoryItemById(int $id): ?InventoryItem
    {
        return $this->repository->getInventoryItemById($id);
    }

    public function createInventoryItem(InventoryItem $inventoryItem): ?int
    {
        return $this->repository->createInventoryItem($inventoryItem);
    }

    public function updateInventoryItem(InventoryItem $inventoryItem): bool
    {
        return $this->repository->updateInventoryItem($inventoryItem);
    }

    public function archiveInventoryItem(int $id): bool
    {
        return $this->repository->archiveInventoryItem($id);
    }
}