<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Transformers\NewsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class NewsController extends Controller
{
    /**
     * @var NewsService
     */
    protected NewsService $newsService;

    /**
     * @var NewsTransformer
     */
    private NewsTransformer $newsTransformer;

    /**
     * @param NewsService $newsService
     * @param NewsTransformer $newsTransformer
     */
    public function __construct(NewsService $newsService, NewsTransformer $newsTransformer)
    {
        $this->newsService = $newsService;
        $this->newsTransformer = $newsTransformer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $news = $this->newsService->getNews($request->all());

        $data = fractal()
            ->collection($news)
            ->transformWith($this->newsTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($news))
            ->withResourceName('news')
            ->toArray();

        return response()->json($data);
    }
}
