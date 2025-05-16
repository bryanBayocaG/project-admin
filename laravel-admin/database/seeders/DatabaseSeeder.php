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
        

        Role::factory()->create([
            "name"=> "Admin",
        ]);
                Role::factory()->create([
            "name"=> "Editor",
        ]);
                Role::factory()->create([
            "name"=> "Viewer",
        ]);

        User::factory(20)->create();
        User::factory()->create([
            'firstName' => 'Admin',
            'lastName' => 'admin',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
        ]);
                User::factory()->create([
            'firstName' => 'Editor',
            'lastName' => 'editor',
            'email' => 'editor@gmail.com',
            'role_id' => 2,
        ]);
                User::factory()->create([
            'firstName' => 'Viewer',
            'lastName' => 'viewer',
            'email' => 'viewer@gmail.com',
            'role_id' => 3,
        ]);
    }
}