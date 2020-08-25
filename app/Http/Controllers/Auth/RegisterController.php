<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\User;
use App\Models\Roles;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     * @throws \Exception
     */
    protected function create(array $data)
    {
 ;
// dd($test);

       User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token'=> Str::random(60),
            'isCustomer'=>false
        ]);
//        Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJ0ZW5hbnRAdGhpbmdzYm9hcmQub3JnIiwic2NvcGVzIjpbIlRFTkFOVF9BRE1JTiJdLCJ1c2VySWQiOiIxMzRjNjA3MC1jMTZkLTExZWEtYjI0ZS03YjRhYmMzOWY4YzEiLCJmaXJzdE5hbWUiOiJ0ZW5hbnQiLCJsYXN0TmFtZSI6InRlbmFudCIsImVuYWJsZWQiOnRydWUsImlzUHVibGljIjpmYWxzZSwidGVuYW50SWQiOiI2NTk4ODMyMC1jMTViLTExZWEtYjI0ZS03YjRhYmMzOWY4YzEiLCJjdXN0b21lcklkIjoiMTM4MTQwMDAtMWRkMi0xMWIyLTgwODAtODA4MDgwODA4MDgwIiwiaXNzIjoidGhpbmdzYm9hcmQuaW8iLCJpYXQiOjE1OTcxNjQ1MjYsImV4cCI6MTU5NzE3MzUyNn0.o7L7zVyTJR8UMrbSUT68CuBjo9AySv9OhJPNKFfPDmAinJIDAPX9nYvX-mRYe5Pw8lBQoSdpdDmkOUbttJKhlw
//        Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJ0ZW5hbnRAdGhpbmdzYm9hcmQub3JnIiwic2NvcGVzIjpbIlRFTkFOVF9BRE1JTiJdLCJ1c2VySWQiOiIxMzRjNjA3MC1jMTZkLTExZWEtYjI0ZS03YjRhYmMzOWY4YzEiLCJmaXJzdE5hbWUiOiJ0ZW5hbnQiLCJsYXN0TmFtZSI6InRlbmFudCIsImVuYWJsZWQiOnRydWUsImlzUHVibGljIjpmYWxzZSwidGVuYW50SWQiOiI2NTk4ODMyMC1jMTViLTExZWEtYjI0ZS03YjRhYmMzOWY4YzEiLCJjdXN0b21lcklkIjoiMTM4MTQwMDAtMWRkMi0xMWIyLTgwODAtODA4MDgwODA4MDgwIiwiaXNzIjoidGhpbmdzYm9hcmQuaW8iLCJpYXQiOjE1OTcxNjQ1MjYsImV4cCI6MTU5NzE3MzUyNn0.o7L7zVyTJR8UMrbSUT68CuBjo9AySv9OhJPNKFfPDmAinJIDAPX9nYvX-mRYe5Pw8lBQoSdpdDmkOUbttJKhlw
    }

}
