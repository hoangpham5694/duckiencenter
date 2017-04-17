<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   	protected $table = 'attendances';
    protected $fillable = [
        'id', 'name', 'study_date', 'status', 'money'
    ];
    public function course(){
        return $this->belongsTo('Course');
    }


}
