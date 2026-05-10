<?php

namespace App\Controllers;

use App\Models\InventoryItem;
use App\Services\Interfaces\IInventoryService;
use App\Services\InventoryItemService;
use App\Framework\Controller;

class InventoryItemController extends Controller
{
    private IInventoryService $inventoryService;

    public function __construct()
    {
        $this->inventoryService = new InventoryItemService();
    }

    public function getAll()
    {
        try {
            $items = $this->inventoryService->getInventoryItems();
            return $this->sendSuccessResponse($items);
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function get($vars = [])
    {
        try {
            $id = (int)($vars['id'] ?? 0);
            $item = $this->inventoryService->getInventoryItemById($id);
            
            if (!$item) {
                return $this->sendErrorResponse('Inventory item not found', 404);
            }
            return $this->sendSuccessResponse($item);
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function create()
    {
        try {
            $item = $this->mapPostDataToClass(InventoryItem::class);
            $itemId = $this->inventoryService->createInventoryItem($item);
            if ($itemId) {
                return $this->sendSuccessResponse(['id' => $itemId], 201);
            } else {
                return $this->sendErrorResponse('Failed to create inventory item', 400);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function update($vars = [])
    {
        try {
            $item = $this->mapPostDataToClass(InventoryItem::class);
            $id = (int)($vars['id'] ?? 0);
            $item->id = $id;
            $success = $this->inventoryService->updateInventoryItem($item);
            if ($success) {
                return $this->sendSuccessResponse($item);
            } else {
                return $this->sendErrorResponse('Failed to update inventory item', 400);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function archive($vars = [])
    {
        try {
            $id = (int)($vars['id'] ?? 0);
            $success = $this->inventoryService->archiveInventoryItem($id);
            if ($success) {
                return $this->sendSuccessResponse(['id' => $id]);
            } else {
                return $this->sendErrorResponse('Failed to archive inventory item', 400);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }
}