<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $table = 'payout';
    protected $fillable = [
        		'teacher_id',
		'user_id',
		'amount',
		'paid_money',
		'paid_day',
		'is_paid'
    ];
    public function teacher(){
        return $this->belongsTo('Teacher');
    }
     public function user(){
        return $this->belongsTo('User');
    }
}
