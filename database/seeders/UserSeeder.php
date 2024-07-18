<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $justin = User::firstOrCreate([
            'email' => 'justinlamaperez@gmail.com',
        ],[
            'name' => 'Justin',
            'password' => 'tijdelijk-' . Carbon::now()->format('d-m'),
            'active' => true
        ]);

        $settings = [
            [
                'name' => 'auto-generate-permissions',
                'type' => 'checkbox',
                'value' => true,
            ]
        ];

        foreach($settings as $setting){
            Setting::firstOrCreate($setting);
    }

        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);

        $justin->assignRole($superAdmin);
    }
}
