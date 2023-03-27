<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsService
{
    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function getNews(array $params): LengthAwarePaginator
    {
        $news = News::query()
            ->when(isset($params['category_id']), function ($q) use ($params) {
                $q->where('category_id', $params['category_id']);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($params['per_page'] ?? config('defaults.pagination.per_page'));

        return $news;
    }

    /**
     * @param int $news_id
     * @return Builder
     */
    public function showNews(int $news_id)
    {
        return News::query()
            ->where('id', $news_id)
            ->first();
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function searchNews(array $params): LengthAwarePaginator
    {
        $news = News::query()
            ->when(isset($params['search']), function ($q) use ($params) {
                $q->where('title', 'LIKE', '%'.$params['search'].'%')
                    ->orWhere('text', 'LIKE', '%'.$params['search'].'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($params['per_page'] ?? config('defaults.pagination.per_page'));

        return $news;
    }
}
