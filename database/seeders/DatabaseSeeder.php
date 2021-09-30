<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'project_manager'
        ]);
        Role::create([
            'name' => 'deputy_project_manager'
        ]);
        Role::create([
            'name' => 'supervisor'
        ]);
        Role::create([
            'name' => 'inspector'
        ]);
        Role::create([
            'name' => 'organization'
        ]);


        User::create([
            'name' => 'عبدالله الحمديان',
            'email' => 'founder@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_ADMIN
        ]);
        User::create([
            'name' => 'خالد فلاتة',
            'email' => 'admin@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_ADMIN
        ]);
        User::create([
            'name' => 'أحمد الدرويش',
            'email' => 'projectmanager1@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_PROJECT_MANAGER
        ]);
        User::create([
            'name' => 'عبدالله بعلبكي',
            'email' => 'projectmanager2@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_PROJECT_MANAGER
        ]);
        User::create([
            'name' => 'سمير الأحمد',
            'email' => 'projectmanager3@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_PROJECT_MANAGER
        ]);
        User::create([
            'name' => 'علاء جواد',
            'email' => 'deputyprojectmanager1@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_DEPUTY_PROJECT_MANAGER
        ]);
        User::create([
            'name' => 'عمر محمد',
            'email' => 'deputyprojectmanager2@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_DEPUTY_PROJECT_MANAGER
        ]);
        User::create([
            'name' => 'محمود مظلوم',
            'email' => 'deputyprojectmanager3@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_DEPUTY_PROJECT_MANAGER
        ]);
        User::create([
            'name' => 'سليمان النصيان',
            'email' => 'supervisor1@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',
            'role_id' => Role::IS_SUPERVISOR
        ]);
        User::create([
            'name' => 'خالد العتيبي',
            'email' => 'inspector1@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',

            'role_id' => Role::IS_INSPECTOR
        ]);
        User::create([
            'name' => 'ثامر السبيعي',
            'email' => 'inspector2@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',

            'role_id' => Role::IS_INSPECTOR
        ]);
        User::create([
            'name' => 'عبدالرحمن التويم',
            'email' => 'inspector3@nytrogin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => '966592713358',

            'role_id' => Role::IS_INSPECTOR
        ]);
    }
}
