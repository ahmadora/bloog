<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;

use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['CUSTOMER_USER','USER','TENANT'];
        foreach ($roles as $role) {
            Roles::create(['name' => $role]);
        }
        Roles::where('name','TENANT')->first()->users()->create([
                'name' => 'tenant',
                'email' => 'tenant@thingsboard.org',
                'password' =>bcrypt('tenant'),
                'token'=> Str::random(60),
                'isCustomer'=>null,
//                'role_id'=>1,
            ]);


    }}
