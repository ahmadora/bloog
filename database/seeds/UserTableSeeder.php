<?php

use App\Models\Customer;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tenant',
            'email' => 'tenant@thingsboard.org',
            'password' =>bcrypt('tenant'),
            'token'=> Str::random(60),
            'isCustomer'=>null,
        ]);
        $users = ['alaa', 'ahmad', 'ali','manaf','bayan'];
        foreach ($users as $user) {
            $name = $user;

            User::create([
                'name' => $name,
                'email' => $name.'@thingsboard.org',
                'password' => bcrypt('123456'),
                'token' => Str::random(60),
                'isCustomer' => false,
            ]);
        }
        $location = ['Damascus','Latakia','Homa'];
        $screens = ['screen 1', 'screen 2', 'screen 3'];
        foreach ($screens as $screen) {
            $name = $screen;
            \App\Screen::create([
                'name' => $name,
                'location' =>$name.'AAA',
                'customerId' =>Str::random(30),
                'deviceId' =>Str::random(30),
            ]);
        }


    }
}
