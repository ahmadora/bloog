<?php


namespace App\Classes;


use App\Models\Roles;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class HelperClass
{
    private $email;
    private $password;
    private $token;


    public function Message($token){
        $this->token = $token;
    }
    /**
     * Helper constructor.
     * @param $email
     * @param $password
     * @param $token
     */
    public function __construct($email,$password,$token)
    {
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }


    function get_Password()
    {
        return $this->password;
    }

    function get_email()
    {
        return $this->email;
    }
    function get_token()
    {
        return $this->token;
    }
    public function tenantToken(){
        $token = DB::table('users')->select('token')->where('name','=','tenant')->first();
        return $token;
    }

    public function checkTenantPassword($password)
    {
        if (Hash::check('tenant', $password)) {
            return true;
        } else {
            return false;
        }
    }
    public function returnPassword($password)
    {
        if ($this->checkTenantPassword($password)) {
            return 'tenant';
        }
    }
    public function isTenant(){
        if ($this->checkTenantPassword(Auth::user()->getAuthPassword())){
            return true;
        }else{
            return false;
        }
    }
    public function checkUserPassword($password)
    {
        if (Hash::check('123456', $password)) {
            return true;
        } else {
            return false;
        }
    }
    public function userPassword($password)
    {
        if ($this->checkUserPassword($password)) {
            return '123456';
        }
    }
    public function isUser(){
        if ($this->checkUserPassword(Auth::user()->getAuthPassword())){
            return true;
        }else{
            return false;
        }
    }

}
