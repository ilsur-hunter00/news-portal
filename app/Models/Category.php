<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
