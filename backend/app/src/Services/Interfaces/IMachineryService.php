<?php

namespace App\Services\Interfaces;

use App\Models\MachineryModel;
use App\Enums\MachineryStatus;

interface IMachineryService
{
    // GET ALL
    public function getMachinery(?string $term = null, ?MachineryStatus $status = null): array;

    // GET BY ID
    public function getMachineryById(int $id): ?MachineryModel;

    // CREATE
    public function createMachinery(MachineryModel $machineryModel): ?int;

    // UPDATE
    public function updateMachinery(MachineryModel $machineryModel): bool;

    // DELETE (soft delete)
    public function archiveMachinery(int $id): bool;
}