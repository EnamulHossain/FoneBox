<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            [
                'group_name' => 'role',
                'permissions' => [
                    'role-list',
                    'role-create',
                    'role-edit',
                    'role-delete',
                ]
            ],
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission-list',
                    'permission-create',
                    'permission-edit',
                    'permission-delete',
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-delete',
                ]
            ],
            [
                'group_name' => 'blog',
                'permissions' => [
                    'blog-list',
                    'blog-create',
                    'blog-edit',
                    'blog-delete',
                ]
            ],

        ];

        $roleSuperAdmin = Role::create(['name' => 'Admin']);
        $roleWriter = Role::create(['name' => 'Writer']);
        $roleUser = Role::create(['name' => 'User']);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
        // Assign super admin role permission to superadmin user
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }

    }
}
