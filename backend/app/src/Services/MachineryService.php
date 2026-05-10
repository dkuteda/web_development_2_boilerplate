<?php

namespace App\Services;

use App\Models\MachineryModel;
use App\Enums\MachineryStatus;
use App\Repositories\Interfaces\IMachineryRepository;
use App\Repositories\MachineryRepository;
use App\Services\Interfaces\IMachineryService;

class MachineryService implements IMachineryService
{
    private IMachineryRepository $machineryRepository;

    public function __construct()
    {
        $this->machineryRepository = new MachineryRepository();
    }

    // GET ALL
    public function getMachinery(?string $term = null, ?MachineryStatus $status = null): array
    {
        return $this->machineryRepository->getMachinery($term, $status);
    }

    // GET BY ID
    public function getMachineryById(int $id): ?MachineryModel
    {
        return $this->machineryRepository->getMachineryById($id);
    }

    // CREATE
    public function createMachinery(MachineryModel $machineryModel): ?int
    {
        return $this->machineryRepository->createMachinery($machineryModel);
    }

    // UPDATE
    public function updateMachinery(MachineryModel $machineryModel): bool
    {
        return $this->machineryRepository->updateMachinery($machineryModel);
    }

    // DELETE (soft delete)
    public function archiveMachinery(int $id): bool
    {
        return $this->machineryRepository->archiveMachinery($id);
    }
}