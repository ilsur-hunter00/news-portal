<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Transformers\NewsTransformer;
use App\Transformers\SearchTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class SearchController extends Controller
{
    /**
     * @var NewsService
     */
    protected NewsService $newsService;

    /**
     * @var SearchTransformer
     */
    private SearchTransformer $searchTransformer;

    /**
     * @param NewsService $newsService
     * @param SearchTransformer $searchTransformer
     */
    public function __construct(NewsService $newsService, SearchTransformer $searchTransformer)
    {
        $this->newsService = $newsService;
        $this->searchTransformer = $searchTransformer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $news = $this->newsService->searchNews($request->all());

        $data = fractal()
            ->collection($news)
            ->transformWith($this->searchTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($news))
            ->withResourceName('news')
            ->toArray();

        return response()->json($data);
    }
}
