<?php

namespace Database\Seeders;

use App\Enums\System\PermissionsEnum;
use App\Enums\System\RolesEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin_role = Role::create(['name' => RolesEnum::ADMIN]);

        $admin_role->syncPermissions([
            Permission::create(['name' => PermissionsEnum::CREATE_USER]),
            Permission::create(['name' => PermissionsEnum::READ_USER]),
            Permission::create(['name' => PermissionsEnum::UPDATE_USER]),
            Permission::create(['name' => PermissionsEnum::DELETE_USER]),
        ]);

        $author_role = Role::create(['name' => RolesEnum::AUTHOR]);

        $author_role->syncPermissions([
            Permission::create(['name' => PermissionsEnum::CREATE_TODO]),
            Permission::create(['name' => PermissionsEnum::READ_TODO]),
            Permission::create(['name' => PermissionsEnum::UPDATE_TODO]),
            Permission::create(['name' => PermissionsEnum::DELETE_TODO]),
            Permission::create(['name' => PermissionsEnum::CHANGE_TODO_STATE]),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
        ]);

        $admin->assignRole($admin_role);
        $admin->assignRole($author_role);
    }
}
