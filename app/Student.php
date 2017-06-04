<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{
    protected $table = 'students';
    protected $fillable = [
        'id',       'username',
        'name',
        'password',
        'dob',
        'address',
        'phone',
        'parents_phone',
        'status',
        'email',
        'firstname',
        'lastname',
        'nation_id',
        'gender',
        'amount',
        'amount_trial',

    ];
    public function payin(){
        return $this->hasMany('Payin');
    }
    public function cource_student(){
        return $this->hasMany('CourceStudent');
    }
    public function nation(){
        return $this->belongsTo('Nations');
    }
 
    public function exam_mark(){
        return $this->hasMany('ExamMark');
    }

}
