<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'html',
                'image' => 'https://icongr.am/devicon/html5-original.svg?size=100',
            ],
            [
                'name' => 'css',
                'image' => 'https://icongr.am/devicon/css3-original.svg?size=100',
            ],
            [
                'name' => 'JavaScript',
                'image' => 'https://icongr.am/devicon/javascript-original.svg?size=100',
            ],
            [
                'name' => 'PHP',
                'image' => 'https://icongr.am/devicon/php-original.svg?size=100',
            ],
            [
                'name' => 'MySQL',
                'image' => 'https://icongr.am/devicon/mysql-original-wordmark.svg?size=100',
            ],
            [
                'name' => 'Laravel',
                'image' => 'https://icongr.am/material/laravel.svg?size=100&color=ff2e2e',
            ],
            [
                'name' => 'Python',
                'image' => 'https://icongr.am/devicon/python-original.svg?size=100',
            ],
            [
                'name' => 'Django',
                'image' => 'https://icongr.am/devicon/django-original.svg?size=100',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
