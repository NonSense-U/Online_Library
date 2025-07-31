<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'aki',
            'fullname' => 'Aki Kon',
            'email' => 'akikon@gmail.com',
            'password' => "123"
        ]);

        $this->call(
            [
                RolesAndPermissionsSeeder::class,
                AuthorSeeder::class,
                PublisherSeeder::class,
                BookSeeder::class,
                GenreSeeder::class
            ]
        );
    }
}
