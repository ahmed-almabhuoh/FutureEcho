<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Exception;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::beginTransaction();

        try {
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

            DB::commit();
            info('User Created');
        } catch (Exception $e) {
            info($e);
            DB::rollBack();
        }
    }
}
