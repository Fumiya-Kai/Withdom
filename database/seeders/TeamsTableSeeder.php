<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('teams')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::pluck('id')->all();
        $data = [
            [
                'name' => 'TensuraTeam',
                'description' => Str::random(100),
            ],
            [
                'name' => 'EngineerTeam',
                'description' => Str::random(150),
            ],
        ];

        foreach ($data as $oneData) {
            $team= new Team();
            $userIdKeys = (array)array_rand($users, random_int(1,3));
            $userIds = [];
            foreach ($userIdKeys as $userIdKey) {
                array_push($userIds, $users[$userIdKey]);
            }
            $team->create($oneData)
                    ->users()
                    ->sync($userIds);
        };
    }
}
