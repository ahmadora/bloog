<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends   Model
{

    protected $table = 'tenants';
    protected $primaryKey = 'id';
    protected $fillable =['id','title','email','phone','address','name','city'
    ];

    public function Customers(){
        return $this->hasMany('App\Models\Customer');
    }
    public function users(){
        return $this->belongsTo('App\User');
    }


}
