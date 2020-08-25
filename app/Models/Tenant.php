<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Tenant extends   Model
{

    protected $table = 'tenants';
    protected $primaryKey = 'id';
    protected $fillable =['id','title','email','phone','address','name','city','role'
    ];

    public function Customers(){
        return $this->hasMany('App\Models\Customer');
    }
    public function users(){
        return $this->belongsTo('App\User');
    }


}
