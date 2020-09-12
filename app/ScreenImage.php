<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScreenImage extends Model
{
    protected $table = 'screen_images';
  protected $fillable = ['screen_id' , 'image_id'];
  public function image(){
      return $this->belongsTo(Image::class);
  }
    public function screen(){
        return $this->belongsTo(Screen::class);
    }
}
