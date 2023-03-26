<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategories(): Collection
    {
        return Category::all();
    }
}
