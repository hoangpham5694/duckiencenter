<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategories extends Model
{
    protected $table = 'news_categories';
    protected $fillable = [
        'id', 'name', 'status'
    ];
    public function news(){
        return $this->hasMany('News');
    }
}
