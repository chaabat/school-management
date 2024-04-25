<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory(25)->create([
            'classe_id' => 1,
            'role_id' => 3,
        ]);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'teacher']);
        Role::create(['name'=>'student']);
        Role::create(['name'=>'parent']);
    }
}
