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
        $admin = User::updateOrCreate([
            'email'=>'admin@gmail.com',
        ], [
            'name'=>'Admin',
            'phone'=>'098 989 8399',
            'password'=>bcrypt('password'),
            'profile' => 'user.avif',
            'role_id' => 1
        ]);
        
        $writer = User::updateOrCreate([
            'email'=>'user@gmail.com',
        ], [
            'name'=>'User',
            'phone'=>'098 989 8391',
            'password'=>bcrypt('password'),
            'role_id' => 2
            
        ]);
        
        $company = User::updateOrCreate([
            'email'=>'company@gmail.com',
        ], [
            'name'=>'Company',
            'phone'=>'098 989 8392',
            'password'=>bcrypt('password'),
            'role_id' => 3

        ]);
        


        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $writer_role = Role::firstOrCreate(['name' => 'user']);
        $company_role = Role::firstOrCreate(['name' => 'company']);

        Permission::firstOrCreate(['name' => 'Post access']);
        Permission::firstOrCreate(['name' => 'Post edit']);
        Permission::firstOrCreate(['name' => 'Post create']);
        Permission::firstOrCreate(['name' => 'Post delete']);

        Permission::firstOrCreate(['name' => 'Role access']);
        Permission::firstOrCreate(['name' => 'Role edit']);
        Permission::firstOrCreate(['name' => 'Role create']);
        Permission::firstOrCreate(['name' => 'Role delete']);

        Permission::firstOrCreate(['name' => 'User access']);
        Permission::firstOrCreate(['name' => 'User edit']);
        Permission::firstOrCreate(['name' => 'User create']);
        Permission::firstOrCreate(['name' => 'User delete']);
        
        Permission::firstOrCreate(['name' => 'Revenue access']);

        Permission::firstOrCreate(['name' => 'Permission access']);
        Permission::firstOrCreate(['name' => 'Permission edit']);
        Permission::firstOrCreate(['name' => 'Permission create']);
        Permission::firstOrCreate(['name' => 'Permission delete']);

        Permission::firstOrCreate(['name' => 'item access']);
        Permission::firstOrCreate(['name' => 'item edit']);
        Permission::firstOrCreate(['name' => 'item create']);
        Permission::firstOrCreate(['name' => 'item delete']);
        Permission::firstOrCreate(['name' => 'item update']);

        Permission::firstOrCreate(['name' => 'category access']);
        Permission::firstOrCreate(['name' => 'category edit']);
        Permission::firstOrCreate(['name' => 'category create']);
        Permission::firstOrCreate(['name' => 'category delete']);
        Permission::firstOrCreate(['name' => 'category update']);

        Permission::firstOrCreate(['name' => 'Company access']);
        Permission::firstOrCreate(['name' => 'Company create']);
        Permission::firstOrCreate(['name' => 'Company edit']);
        Permission::firstOrCreate(['name' => 'Company delete']);

        Permission::firstOrCreate(['name' => 'OptionPaid access']);
        Permission::firstOrCreate(['name' => 'OptionPaid create']);
        Permission::firstOrCreate(['name' => 'OptionPaid edit']);
        Permission::firstOrCreate(['name' => 'OptionPaid delete']);
        
        Permission::firstOrCreate(['name' => 'history access']);

        Permission::firstOrCreate(['name' => 'Mail access']);
        Permission::firstOrCreate(['name' => 'Mail edit']);

        

        $admin->syncRoles([$admin_role]);
        $writer->syncRoles([$writer_role]);
        $company->syncRoles([$company_role]);

        $admin_role->syncPermissions(Permission::all());
    }
}
