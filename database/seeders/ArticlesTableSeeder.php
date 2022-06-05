<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::pluck('id')->all();
        $teams = Team::pluck('id')->all();
        $categories = Category::pluck('id')->all();

        for ($i=0; $i <= 50; $i++) {
            $data = [
                'title' => Str::random(10),
                'abstract' => Str::random(20),
                'content' => Str::random(100),
                'team_id' => $teams[array_rand($teams)],
                'user_id' => $users[array_rand($users)]
            ];
            $article= new Article();
            $categoryIdKeys = (array)array_rand($categories, random_int(1,8));
            $categoryIds = [];
            foreach ($categoryIdKeys as $categoryIdKey) {
                array_push($categoryIds, $categories[$categoryIdKey]);
            }
            $article->create($data)
                    ->categories()
                    ->sync($categoryIds);
        };
    }
}
