<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'id', 'description','max_students', 'fee', 'name', 'status', 'teacher_id', 'opening_date', 'agency_id'
    ];
    public function course_monthly(){
        return $this->hasMany('CourceMonthly');
    }
    public function course_student(){
        return $this->hasMany('CourceStudent');
    }
    public function teacher(){
        return $this->belongsTo('Teacher');
    }
    public function agency(){
        return $this->belongsTo('Agency');
    }
}
