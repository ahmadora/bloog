<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $table = 'screens';
    protected $primaryKey = 'id';
    protected $fillable = [
         'name','customerId','location'
    ];
}
