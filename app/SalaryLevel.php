<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryLevel extends Model
{
    protected $table = 'salary_level';
    protected $fillable = [
        'id', 'percent'
    ];
    public function teacher(){
        return $this->hasMany('Teacher');
    }
}
