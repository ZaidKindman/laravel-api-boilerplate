<?php

namespace Database\Seeders;

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
        $admin_role = Role::create(['name' => 'admin']);

        $admin_role->syncPermissions([
            Permission::create(['name' => 'create user']),
            Permission::create(['name' => 'edit user']),
            Permission::create(['name' => 'delete user']),
            Permission::create(['name' => 'view user']),
            Permission::create(['name' => 'create role']),
            Permission::create(['name' => 'edit role']),
            Permission::create(['name' => 'delete role']),
            Permission::create(['name' => 'view role']),
        ]);

        $author_role = Role::create(['name' => 'author']);

        $author_role->syncPermissions([
            Permission::create(['name' => 'create todo']),
            Permission::create(['name' => 'edit todo']),
            Permission::create(['name' => 'delete todo']),
            Permission::create(['name' => 'view todo']),
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
