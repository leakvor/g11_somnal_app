<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone'=>'098-989-8399',
            'password'=>bcrypt('password'),
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'phone'=>'098-989-8391',
            'password'=>bcrypt('password')

        ]);
        


        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'user']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'item access']);
        $permission = Permission::create(['name' => 'item edit']);
        $permission = Permission::create(['name' => 'item create']);
        $permission = Permission::create(['name' => 'item delete']);
        $permission = Permission::create(['name' => 'item update']);

        $permission = Permission::create(['name' => 'category access']);
        $permission = Permission::create(['name' => 'category edit']);
        $permission = Permission::create(['name' => 'category create']);
        $permission = Permission::create(['name' => 'category delete']);
        $permission = Permission::create(['name' => 'category update']);

        $permission = Permission::create(['name' => 'Company access']);
        $permission = Permission::create(['name' => 'Company create']);
        $permission = Permission::create(['name' => 'Company edit']);
        $permission = Permission::create(['name' => 'Company delete']);

        $permission = Permission::create(['name' => 'history access']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);



        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);


        $admin_role->givePermissionTo(Permission::all());
    }
}
