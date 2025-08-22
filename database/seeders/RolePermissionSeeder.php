<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage products',
            'view products',
            'create products',
            'update products',
            'delete products',
            'manage orders',
            'manage categories',
            'manage reviews',
            'view dashboard',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $adminRole->givePermissionTo(Permission::all());
        $managerRole->givePermissionTo(['manage products', 'manage categories', 'view dashboard', 'manage reviews','view products']);
        $userRole->givePermissionTo(['view dashboard']);

        $admin = User::first();
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}
