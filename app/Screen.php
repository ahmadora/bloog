<?php

namespace App;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $table = 'screens';
    protected $primaryKey = 'id';
    protected $fillable = [
         'name','customerId','location'
    ];
    public function screenImage(){
        return $this->hasMany(ScreenImage::class);
    }
    public function device(){
        return $this->belongsTo(Device::class);
    }

}
