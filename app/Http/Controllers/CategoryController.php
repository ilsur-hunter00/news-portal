<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * @var CategoryTransformer
     */
    private CategoryTransformer $categoryTransformer;

    /**
     * @param CategoryService $categoryService
     * @param CategoryTransformer $categoryTransformer
     */
    public function __construct(CategoryService $categoryService, CategoryTransformer $categoryTransformer)
    {
        $this->categoryService = $categoryService;
        $this->categoryTransformer = $categoryTransformer;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getCategories();

        $data = fractal()
            ->collection($categories)
            ->transformWith($this->categoryTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->withResourceName('categories')
            ->toArray();

        return response()->json($data);
    }
}
