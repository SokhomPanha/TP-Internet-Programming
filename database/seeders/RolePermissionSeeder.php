<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Roles Create
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $staffRole = Role::create(['name' => 'staff']);

        //Permissions Create
        $permissions = [
            'users.manage',
            'projects.create', 'projects.update', 'projects.delete',
            'tasks.create', 'tasks.update', 'tasks.delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        //Assign Permissions to Roles
        $adminRole->permissions()->attach(Permission::all());
        $managerRole->permissions()->attach(Permission::whereIn('name', [
            'projects.create', 'projects.update',
            'tasks.create', 'tasks.update',
        ])->get());

        $staffRole->permissions()->attach(Permission::whereIn('name', [
            'tasks.update',

        ])->get());


        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($adminRole->id);


        $managerUser = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);
        $managerUser->roles()->attach($managerRole);

        $staff1 = User::create([
            'name' => 'Staff User 1',
            'email' => 'staff1@example.com',
            'password' => Hash::make('password'),
        ]);
        $staff1->roles()->attach($staffRole);

        $staff2 = User::create([
            'name' => 'Staff User 2',
            'email' => 'staff2@example.com',
            'password' => Hash::make('password'),
        ]);
        $staff2->roles()->attach($staffRole);




    }


}
