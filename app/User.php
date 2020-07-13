<?php

namespace App;

use App\Classes\Property;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'role_id');
    }

    public function customer()
    {
        return $this->hasMany('App\Models\customer');
    }
    public static function getProperties()
    {
        return [
            new Property('ID', null, function($item){ return $item->id; }),
            new Property('Email', null, function($item){ return $item->email; }),
            new Property('Name', null, function($item){ return $item->name; }),
            new Property('Customer',null,function ($item){return $item->isCustomer;}),
            new Property('Action', 'hyperlink', function($item){
                return [
                    'link'=>route('dashboard.publishers.editPermissions', $item->id),
                    'text'=>'Update permissions'
                ];
            }),
        ];
    }
}
