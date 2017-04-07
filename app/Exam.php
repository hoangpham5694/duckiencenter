<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $fillable = [
        'id', 'name' ,'course_id', 'description','exam_date', 'status'
    ];
    public function course(){
        return $this->belongsTo('Course');
    }
    public function exam_mark(){
        return $this->hasMany('ExamMark');
    }
}
