<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Verifica se já existe um administrador cadastrado
        if (!User::where('email', 'admin@example.com')->exists()) {
            // Cria o administrador
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => Hash::make('Admin@1234'), // Defina uma senha segura
                'is_admin' => true, // Marca como administrador
            ]);
        }
    }
}
