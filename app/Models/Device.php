<?php

namespace App\Models;

use App\Screen;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';
    protected $primaryKey = 'id';
    protected $fillable =['id','name','type','label','deviceId','tenantId','credentialsType','credentialsId','screenId'
    ];


    public function screen(){
        return $this->hasOne(Screen::class);
    }
}
