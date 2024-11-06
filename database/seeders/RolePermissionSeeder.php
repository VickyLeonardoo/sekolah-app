<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'superadmin',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);

        $parentRole = Role::create([
            'name' => 'parent'
        ]);

        //Super admin
        $userSuperAdmin = User::create([
            'name' => 'Superadmin',
            'identity_no' => '123456789',
            'phone' => '0123456789',
            'email' => 'sadmin@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userParent = User::create([
            'name' => 'Pikimoy',
            'identity_no' => '223456789',
            'phone' => '0223456789',
            'email' => 'user1@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userSuperAdmin->assignRole($superAdminRole);
        $userParent->assignRole($parentRole);
        
    }
}
