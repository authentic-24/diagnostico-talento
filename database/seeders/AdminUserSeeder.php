<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los roles 'admin' y 'user' si no existen, con el guard 'web'
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $admin = User::updateOrCreate(
            ['email' => 'authentic@talent.com'],
            [
                'name' => 'Administrador',
                'empresa' => 'TalentCheck',
                'telefono' => '999999999',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}
