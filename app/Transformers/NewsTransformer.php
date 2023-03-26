<?php

namespace App\Transformers;

use App\Models\News;
use League\Fractal\TransformerAbstract;

class NewsTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(News $news)
    {
        return [
            'id' => $news->id,
            'category_id' => $news->category_id,
            'author_id' => $news->author_id,
            'title' => $news->title,
            'text' => $news->text,
            'head_image' => $news->head_image
        ];
    }
}
