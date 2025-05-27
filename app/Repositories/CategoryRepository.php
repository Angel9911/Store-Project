<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{

    public function getCategories(): \LaravelIdea\Helper\App\Models\_IH_Category_C|\Illuminate\Database\Eloquent\Collection|array
    {
        return Category::all();
    }

    public function find($id): \LaravelIdea\Helper\App\Models\_IH_Category_C|array|Category
    {
        return Category::findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
