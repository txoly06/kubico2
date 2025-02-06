<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         // Criar o papel de administrador
         $adminRole = Role::create(['name' => 'admin']);

         // Procurar o usuário administrador pelo e-mail
         $user = User::where('email', 'admin@gmail.com')->first();
 
         if ($user) {
             // Atribuir o papel de administrador ao usuário existente
             $user->assignRole($adminRole);
         } else {
             // Opcionalmente, criar um novo usuário administrador
             $user = User::create([
                 'name' => 'Administrador',
                 'email' => 'adm@gmail.com',
                 'password' => bcrypt('kubico'),
             ]);
 
             $user->assignRole($adminRole);
         }
    }
}
