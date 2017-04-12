<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';
    protected $fillable = [
        'id', 'name' , 'status', 'created_at'
    ];


    public function payment(){
        return $this->hasMany('Payment');
    }
    public function course_monthly(){
        return $this->hasMany('CourceMonthly');
    }
}
