<?php
namespace App\Repositories;

use App\Models\Article;

interface IInventoryItemRepository
{
    /**
     * @param string|null $term
     * @param string|null $category
     * @return array
     */
    public function getInventoryItems(?string $term = null, ?string $category = null): array;
}