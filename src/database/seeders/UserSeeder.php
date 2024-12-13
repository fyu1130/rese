<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $shopManagerRole = Role::where('name', 'shop_manager')->first();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('20021130'),
            'role_id' => $adminRole->id,
        ]);
        User::create([
            'name' => 'Shop Manager1',
            'email' => 'shopmanager1@example.com',
            'password' => bcrypt('20021130'),
            'role_id' => $shopManagerRole->id,
        ]);
        User::create([
            'name' => 'Shop Manager2',
            'email' => 'shopmanager2@example.com',
            'password' => bcrypt('20021130'),
            'role_id' => $shopManagerRole->id,
        ]);
        User::create([
            'name' => 'Shop Manager3',
            'email' => 'shopmanager3@example.com',
            'password' => bcrypt('20021130'),
            'role_id' => $shopManagerRole->id,
        ]);
        User::create([
            'name' => 'Shop Manager4',
            'email' => 'shopmanager4@example.com',
            'password' => bcrypt('20021130'),
            'role_id' => $shopManagerRole->id,
        ]);
        User::create([
            'name' => 'Shop Manager5',
            'email' => 'shopmanager5@example.com',
            'password' => bcrypt('20021130'),
            'role_id' => $shopManagerRole->id,
        ]);
    }
}
