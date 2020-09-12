<?php

namespace App;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table ='images';
    protected $fillable = ['id','path','duration','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function image(){
        return $this->hasMany(ScreenImage::class);
    }

    public function device(){
        return $this->belongsTo(Device::class);
    }
}
