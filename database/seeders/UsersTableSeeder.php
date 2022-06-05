<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
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
                'name' => 'LimuruTempest',
                'email' => Str::random(10).'@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'LuminousValentine',
                'email' => Str::random(10).'@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        DB::table('users')->insert($data);

    }
}
