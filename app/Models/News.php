<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property int $author_id
 * @property string $title
 * @property string $text
 * @property string $head_image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'text',
        'head_image',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
