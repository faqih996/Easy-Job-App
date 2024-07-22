<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage categories',
            'manage company',
            'manage jobs',
            'manage candidates',
            'apply job',
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // employer permissions
        $employerRole = Role::firstOrCreate([
            'name' => 'employer'
        ]);

        $employerPermissions = [
            'manage company',
            'manage jobs',
            'manage candidates',
        ];

        $employerRole->syncPermissions($employerPermissions);

        // employee permissions
        $employeeRole = Role::firstOrCreate([
            'name' => 'employee'
        ]);

        $employeePermissions = [
            'apply job',
        ];

        $employeeRole->syncPermissions($employeePermissions);


        // super admin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'occupation' => 'superadmin',
            'avatar' => 'images/profile.jpg',
            'experience' => 500,
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        $user->assignRole($superAdminRole);

    }
}
