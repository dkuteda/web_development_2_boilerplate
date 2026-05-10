<?php

namespace App\Controllers;

use App\Models\MachineryModel;
use App\Enums\MachineryStatus;
use App\Services\Interfaces\IMachineryService;
use App\Services\MachineryService;
use App\Framework\Controller;

class MachineryController extends Controller
{
    private IMachineryService $machineryService;

    public function __construct()
    {
        $this->machineryService = new MachineryService();
    }

    public function index()
    {
        try {
            $machinery = $this->machineryService->getMachinery();
            return $this->sendSuccessResponse($machinery);
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function get($vars = [])
    {
        try {
            $id = (int)($vars['id'] ?? 0);
            $machine = $this->machineryService->getMachineryById($id);
            
            if (!$machine) {
                return $this->sendErrorResponse('Machinery not found', 404);
            }
            return $this->sendSuccessResponse($machine);
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function create()
    {
        try {
            $machine = $this->mapPostDataToClass(MachineryModel::class);
            $machineId = $this->machineryService->createMachinery($machine);
            if ($machineId) {
                return $this->sendSuccessResponse(['id' => $machineId], 201);
            } else {
                return $this->sendErrorResponse('Failed to create machinery', 400);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function update($vars = [])
    {
        try {
            $id = (int)($vars['id'] ?? 0);
            $machine = $this->mapPostDataToClass(MachineryModel::class);
            $updated = $this->machineryService->updateMachinery($machine);
            if ($updated) {
                return $this->sendSuccessResponse(['id' => $id]);
            } else {
                return $this->sendErrorResponse('Failed to update machinery', 400);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }

    public function archive($vars = [])
    {
        try {
            $id = (int)($vars['id'] ?? 0);
            $success = $this->machineryService->archiveMachinery($id);
            if ($success) {
                return $this->sendSuccessResponse(['id' => $id]);
            } else {
                return $this->sendErrorResponse('Failed to archive machinery', 400);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $this->sendErrorResponse('Internal server error', 500);
        }
    }
}   
