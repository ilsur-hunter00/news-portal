<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = new News();
        $news->category_id = 1;
        $news->author_id = 1;
        $news->title = 'Белые медведи';
        $news->text = Storage::get('newsExample.txt');
        $news->head_image = 'https://faunistics.com/wp-content/uploads/2019/06/2-5.jpg';
        $news->save();
    }
}
