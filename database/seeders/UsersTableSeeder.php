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
                'name' => 'guest',
                'email' => 'guest@guest.com',
                'password' => Hash::make('guestpass'),
            ],
            [
                'name' => 'FumiyaKai',
                'email' => 'physics.math.science238@gmail.com',
                'password' => Hash::make('Rmn-1/2gmnR=kTmn'),
            ],
        ];

        DB::table('users')->insert($data);

    }
}
