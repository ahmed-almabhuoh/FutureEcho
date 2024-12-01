<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserGroup;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Establish all data you need to start your adventure in the Future Echo System';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $permissions_en = config('roles-permissions.permissions-en');
        $permissions_ar = config('roles-permissions.permissions-ar');
        $roles_en = config('roles-permissions.roles-en');
        $roles_ar = config('roles-permissions.roles-ar');
        $user_groups = config('roles-permissions.user-groups');
        $role_permissions_assign = config('roles-permissions.role-permissions-assign');

        DB::beginTransaction();

        try {
            // User Group Operations
            foreach ($user_groups as $key => $value) {

                // User Groups Creation
                if (!UserGroup::where([
                    ['name_ar', '=', $value['ar']],
                    ['name_en', '=', $value['en']],
                ])->exists())
                    $userGroupObject = UserGroup::create([
                        'name_ar' => $value['ar'],
                        'name_en' => $value['en'],
                    ]);
                else
                    $userGroupObject = UserGroup::where([
                        ['name_ar', '=', $value['ar']],
                        ['name_en', '=', $value['en']],
                    ])->first();

                // Roles Creation
                if (is_array($value['roles'])) {
                    foreach ($value['roles'] as $userGroupKeyRole => $userGroupValueRole) {
                        if (! Role::where([
                            ['role_ar', '=', $roles_ar[$userGroupValueRole]],
                            ['role_en', '=', $roles_en[$userGroupValueRole]],
                            ['user_group_id', '=',  $userGroupObject->id],
                        ])->exists())
                            $roleObject = Role::create([
                                'role_ar' => $roles_ar[$userGroupValueRole],
                                'role_en' => $roles_en[$userGroupValueRole],
                                'user_group_id' => $userGroupObject->id,
                            ]);
                        else
                            continue;
                    }
                } else { // Which means it is a string = '*'
                    foreach ($roles_en as $role_en_key => $role_en_value) {
                        foreach ($roles_ar as $role_ar_key => $role_ar_value) {
                            if ($role_ar_key == $role_en_key)
                                if (! Role::where([
                                    ['role_ar', '=', $role_ar_value],
                                    ['role_en', '=', $role_en_value],
                                    ['user_group_id', '=',  $userGroupObject->id],
                                ])->exists())
                                    $roleObject = Role::create([
                                        'role_ar' => $role_ar_value,
                                        'role_en' => $role_en_value,
                                        'user_group_id' => $userGroupObject->id,
                                    ]);
                                else
                                    continue;
                            else
                                continue;
                        }
                    }
                }

                // Permissions Creation
                if (is_array($value['permissions'])) {
                    foreach ($value['permissions'] as $userGroupKeyPermission => $userGroupValuePermission) {
                        if (! Permission::where([
                            ['name_ar', '=', $permissions_ar[$userGroupValuePermission]],
                            ['name_en', '=', $permissions_en[$userGroupValuePermission]],
                            ['user_group_id', '=',  $userGroupObject->id],
                        ])->exists())
                            $permissionObject = Role::create([
                                'name_ar' => $permissions_ar[$userGroupValuePermission],
                                'name_en' => $permissions_en[$userGroupValuePermission],
                                'user_group_id' => $userGroupObject->id,
                            ]);
                        else
                            continue;
                    }
                } else { // Which means it is a string = '*'
                    foreach ($permissions_en as $permission_en_key => $permission_en_value) {
                        foreach ($permissions_ar as $permission_ar_key => $permission_ar_value) {
                            if ($permission_ar_key == $permission_en_key)
                                if (! Permission::where([
                                    ['name_ar', '=', $permission_ar_value],
                                    ['name_en', '=', $permission_en_value],
                                    ['user_group_id', '=',  $userGroupObject->id],
                                ])->exists())
                                    $permissionObject = Permission::create([
                                        'name_ar' => $permission_ar_value,
                                        'name_en' => $permission_en_value,
                                        'user_group_id' => $userGroupObject->id,
                                    ]);
                                else
                                    continue;
                            else
                                continue;
                        }
                    }
                }
            }

            // Assigning Operations
            foreach ($role_permissions_assign as $role => $permissions) {
                $roleObject = Role::where('role_en', unsluging($role))->first();

                if (is_array($permissions)) {
                    foreach ($permissions as $key => $permission) {
                        $permissionObject = Permission::where('name_en', unsluging($permission))->first();
                        if (! RolePermission::where([
                            ['role_id', '=', $roleObject->id],
                            ['permission_id', '=', $permissionObject->id],
                        ])->exists())
                            RolePermission::create([
                                'role_id' => $roleObject->id,
                                'permission_id' => $permissionObject->id,
                                'assigned_at' => now(),
                            ]);
                        else
                            continue;
                    }
                } else {
                    $permission_ids = Permission::select(['id'])->get()->pluck('id')->toArray();
                    foreach ($permission_ids as $key => $permission_id) {
                        if (! RolePermission::where([
                            ['role_id', '=', $roleObject->id],
                            ['permission_id', '=', $permission_id],
                        ])->exists())
                            RolePermission::create([
                                'role_id' => $roleObject->id,
                                'permission_id' => $permission_id,
                                'assigned_at' => now(),
                            ]);
                        else
                            continue;
                    }
                }
            }

            // Artisan::command('db:seed');

            // Should be removed from here
            User::factory()->create([
                'name' => 'Future Echo',
                'email' => 'f.echo@hophearts.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => '2024-10-05 15:34:05',
            ]);

            $user = User::where('email', 'f.echo@hophearts.com')->first();
            $role = Role::where('role_en', 'Super Admin')->first();

            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $role->id,
                'assigned_at' => now(),
            ]);
            // End to remove

            DB::commit();
            info('All configurations have been setup!');
        } catch (Exception $e) {
            info($e);
            DB::rollBack();
        }
    }
}
