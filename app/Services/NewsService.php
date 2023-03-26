<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsService
{
    /**
     * @param $params
     * @return LengthAwarePaginator
     */
    public function getNews($params): LengthAwarePaginator
    {
        return News::query()
            ->orderBy('created_at', 'desc')
            ->paginate($params['per_page'] ?? config('defaults.pagination.per_page'));
    }
}
