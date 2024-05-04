<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Subjects;
use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\DB;

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
        Permission::create(['name' => 'create class']);
        Permission::create(['name' => 'create subject']);
        Permission::create(['name' => 'view all']);
        Permission::create(['name' => 'view teacher']);
        Permission::create(['name' => 'view student']);


        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(['feedback']);
        $superAdminRole->givePermissionTo(['comment']);
        $superAdminRole->givePermissionTo(['create student']);
        $superAdminRole->givePermissionTo(['create teacher']);
        $superAdminRole->givePermissionTo(['create class']);
        $superAdminRole->givePermissionTo(['create subject']);
        $superAdminRole->givePermissionTo(['attach class']);
        $superAdminRole->givePermissionTo(['attach subject']);
        $superAdminRole->givePermissionTo(['view all']);

        $teacher = Role::create(['name' => 'teacher']);
        $teacher->givePermissionTo(['view teacher']);

        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo(['feedback']);
        $student->givePermissionTo(['comment']);
        $student->givePermissionTo(['view student']);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin$123')),
            'cpf' => '12345678912',
            'role_id' => '1'
        ]);

        $admin->assignRole($superAdminRole);
    }
}
