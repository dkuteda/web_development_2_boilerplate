<?php

namespace App\Models;

use App\Enums\MachineryStatus;

class MachineryModel
{
    public int $MachineryId;
    public string $MachineryName;
    public string $Description;
    public MachineryStatus $Status;

    public static function fromDb(array $data): self
    {
        $machinery = new self();
        $machinery->MachineryId = (int)$data['MachineryId'];
        $machinery->MachineryName = $data['MachineryName'];
        $machinery->Description = $data['Description'] ?? '';
        $machinery->Status = MachineryStatus::from($data['Status']);
        
        return $machinery;
    }
}