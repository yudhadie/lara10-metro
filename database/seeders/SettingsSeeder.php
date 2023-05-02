<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Team
        Team::create([
            'id' => 1,
            'user_id' => '1',
            'name' => 'ADMIN',
            'personal_team' => '1',
        ]);
        Team::create([
            'id' => 2,
            'user_id' => '1',
            'name' => 'USER',
            'personal_team' => '1',
        ]);

        //User
        User::create([
            'id' => '1',
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'current_team_id' => 1,
        ]);

        User::create([
            'id' => '2',
            'username' => 'user',
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user123'),
            'current_team_id' => 2,
        ]);
    }
}
