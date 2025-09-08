<?php

namespace Database\Seeders;

use App\Models\type_users;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersSeaders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminType = type_users::create([
            'name' => 'Admin',
        ]);

        $user = user::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123#'),
            'type_user_id' => $adminType->id,
        ]);

        $permissions = [
            ['name' => 'users'],
            ['name' => 'user.edit'],
            ['name' => 'user.create'],
            ['name' => 'user.delete'],
            ['name' => 'user.read'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                ['guard_name' => 'sanctum']
            );
        }

        $roleAdmin = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['guard_name' => 'sanctum']
        );

        $roleAdmin->syncPermissions(Permission::where('guard_name', 'sanctum')->get());
        $user->assignRole($roleAdmin);
    }
}
