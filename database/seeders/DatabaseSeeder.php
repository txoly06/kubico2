<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //criando papel do adm
       // $adminRole = Role::create(['name' => 'admin']);
       $this->call([
        RolesAndPermissionsSeeder::class,
        ]);
       // $user = User::where('email', 'admin@seusistema.com')->first();
        //$user->assignRole('admin');

    }
}
