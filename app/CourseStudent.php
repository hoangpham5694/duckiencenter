<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
	protected $table = 'course_student';
    protected $fillable = [
        'id', 'course_id', 'course_id', 'status'
    ];

    public function student(){
        return $this->belongsTo('Student');
    }
    public function course(){
        return $this->belongsTo('Course');
    }

}
