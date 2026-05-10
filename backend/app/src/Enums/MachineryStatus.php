<?php

namespace App\Enums;

enum MachineryStatus: string
{
    case Available = 'available';
    case InUse = 'in_use';
    case UnderMaintenance = 'under_maintenance';

    public static function toSelectOptions(): array
    {
        return array_reduce(self::cases(), function (array $carry, self $case) {
            // Converts [MachineryStatus::Available] to ['available' => 'Available']
            $carry[$case->value] = $case->name; 
            return $carry;
        }, []);
    }
}