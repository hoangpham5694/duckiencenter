<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Teacher extends Authenticatable
{
    protected $table = 'teachers';
    protected $fillable = [
        'id',
                'username',
        'name',
        'password',
        'dob',
        'address',
        'phone',
        'agency_id',
        'status',
        'email',
        'firstname',
        'lastname',
        'image',
        'diploma',
        'degree',
        'salary_level_id',
        'skill',
        'work_history',
        'amount'

    ];
    protected $hidden = [
        'password',
    ];

    public function cource(){
        return $this->hasMany('Cource');
    }

    public function salary_level(){
        return $this->belongsTo('SalaryLevel');
    }
}
