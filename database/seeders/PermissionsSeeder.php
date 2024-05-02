<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'feedback']);
        Permission::create(['name' => 'comment']);
        Permission::create(['name' => 'create student']);
        Permission::create(['name' => 'create teacher']);
        Permission::create(['name' => 'attach class']);
        Permission::create(['name' => 'attach subject']);

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo('feedback');
        $superAdminRole->givePermissionTo('comment');
        $superAdminRole->givePermissionTo('create student');
        $superAdminRole->givePermissionTo('create teacher');
        $superAdminRole->givePermissionTo('attach class');
        $superAdminRole->givePermissionTo('attach subject');

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin$123')),
            'cpf' => '12345678912',
        ]);

        $admin->assignRole($superAdminRole);
    }
}
