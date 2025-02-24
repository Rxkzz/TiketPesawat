<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Truncate tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create Filament Shield Permissions
        $permissions = [
            // Panel Admin Permission
            'access_filament',
            'view_admin_panel',

            // Pemesanan Resource
            'view_any_pemesanan',
            'view_pemesanan',
            'create_pemesanan',
            'update_pemesanan',
            'delete_pemesanan',
            'verify_payment_pemesanan',

            // Shield Resource (untuk super admin)
            'view_any_shield::role',
            'view_shield::role',
            'create_shield::role',
            'update_shield::role',
            'delete_shield::role',
            'view_shield::permission',
            'view_any_shield::permission',
            'create_shield::permission',
            'update_shield::permission',
            'delete_shield::permission',

            // User Resource (untuk super admin)
            'view_any_users',
            'view_users',
            'create_users',
            'update_users',
            'delete_users',
            'manage_users',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $petugasRole = Role::create(['name' => 'petugas', 'guard_name' => 'web']);

        // Assign Permissions to Roles
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin hanya bisa akses pemesanan dengan full akses
        $adminRole->givePermissionTo([
            'access_filament',
            'view_admin_panel',
            'view_any_pemesanan',
            'view_pemesanan',
            'create_pemesanan',
            'update_pemesanan',
            'delete_pemesanan',
            'verify_payment_pemesanan',
        ]);

        // Petugas hanya bisa view dan verifikasi pemesanan
        $petugasRole->givePermissionTo([
            'access_filament',
            'view_admin_panel',
            'view_any_pemesanan',
            'view_pemesanan',
            'verify_payment_pemesanan',
        ]);

        // Create Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('super_admin');

        // Create Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Create Petugas User
        $petugas = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@admin.com',
            'password' => Hash::make('password'),
        ]);
        $petugas->assignRole('petugas');
    }
} 