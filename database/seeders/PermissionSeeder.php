<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'View Role', 'group' => 'Role'],
            ['name' => 'Create Role', 'group' => 'Role'],
            ['name' => 'Edit Role', 'group' => 'Role'],
            ['name' => 'Delete Role', 'group' => 'Role'],

            ['name' => 'View Property', 'group' => 'Property'],
            ['name' => 'Create Property', 'group' => 'Property'],
            ['name' => 'Edit Property', 'group' => 'Property'],
            ['name' => 'Delete Property', 'group' => 'Property'],

            ['name' => 'View User Request', 'group' => 'User Request'],
            
        ];

        $permissionNames = collect($permissions)->pluck('name')->toArray();
        Permission::whereNotIn('name', $permissionNames)->delete();

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
