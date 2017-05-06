<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'id', 'title', 'status', 'content','cate_id','description','image','slug'
    ];

}
