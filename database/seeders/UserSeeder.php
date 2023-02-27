<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->CreatePermissions();
    }


    
    public function createRoles(){
        /** ປະເພດ User */
        $roleSuperAdmin = Role::create([
            'name' => 'superadmin', 'display_name' => 'Super Admin'
        ]);

        $roleAdmin = Role::create([
            'name' => 'admin', 'display_name' => 'Admin'
        ]);

        # Create User => Super Admin
        $createUserSuperAdmin = User::create([
            'name' => 'admin', 
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('super@2023'),
        ]);
        $createUserSuperAdmin->attachRoles([$roleSuperAdmin]);

        $createUserAdmin = User::create([
            'name' => 'admin', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@2023'),
        ]);
        $createUserAdmin->attachRoles([$roleAdmin]);

        
    }

    public function CreatePermissions(){
        Permission::create(['name' => 'add', 'display_name' => 'Add']);
        Permission::create(['name' => 'edit', 'display_name' => 'edit']);
        Permission::create(['name' => 'view', 'display_name' => 'view']);
        Permission::create(['name' => 'delete', 'display_name' => 'delete']);
    }
}
