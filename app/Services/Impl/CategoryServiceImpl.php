<?php

namespace App\Services\Impl;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;

class CategoryServiceImpl implements CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function getCategories(): \LaravelIdea\Helper\App\Models\_IH_Category_C|\Illuminate\Database\Eloquent\Collection|array
    {
        return $this->categoryRepository->getCategories();
    }

    public function createCategory(array $categoryData): Category
    {
        return $this->categoryRepository->create($categoryData);
    }
}
