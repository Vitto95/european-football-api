<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = UserRole::where('name', 'admin')->first();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role_id' => $admin_role->id ?? null,
        ]);
    }
}
