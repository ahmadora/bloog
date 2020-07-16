<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable =['id','title','email','phone','address'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
