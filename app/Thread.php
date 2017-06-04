<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
      protected $table = 'threads';
    protected $fillable = [
        'id',
        'title',
        'content',
        'teacher_id',
        'student_id',
        'type',
        'status',
        'created_at',
        'updated_at'
        

    ];


    public function thread_comment(){
        return $this->hasMany('ThreadComment');
    }

    public function course(){
        return $this->belongsTo('Course');
    }
}
