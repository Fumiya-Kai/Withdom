<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::pluck('id')->all();
        $articles = Article::pluck('id')->all();
        $data = [];

        for ($i=0; $i <= 50; $i++) {
            array_push(
                $data,
                [
                    'content' => Str::random(100),
                    'article_id' => $articles[array_rand($articles)],
                    'user_id' => $users[array_rand($users)]
                ]
                );
        };

        DB::table('comments')->insert($data);
    }
}
