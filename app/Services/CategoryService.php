<?php

namespace App\Services;

use App\Models\Category;

interface CategoryService
{
    public function createCategory(array $categoryData): Category;
    public function getCategories();
}
