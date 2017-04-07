<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Teacher extends Authenticatable
{
    protected $table = 'teachers';
    protected $fillable = [
        'id', 'address', 'dob', 'name', 'status', 'username', 'phone', 'agency_id'
    ];
    protected $hidden = [
        'password',
    ];
    public function payment(){
        return $this->hasMany('Payment');
    }
    public function cource(){
        return $this->hasMany('Cource');
    }
    public function agency(){
        return $this->belongsTo('Agency');
    }
}
