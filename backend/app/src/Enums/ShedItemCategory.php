<?php
namespace App\Models;

enum ProductCategory: string
{
    case Soil = 'soil';
    case Planting = 'planting';
    case PestControl = 'pest_control';
    

    public static function toSelectOptions(): array
    {
        return array_reduce(self::cases(), function (array $carry, self $case) {
            // Converts [Category::Computers] to ['computers' => 'Computers']
            $carry[$case->value] = $case->name; 
            return $carry;
        }, []);
    }
}