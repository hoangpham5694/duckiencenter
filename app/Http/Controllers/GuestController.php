<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\NewsCategories;
class GuestController extends Controller
{
    public function getIndex()
    {
    	$lastNews = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','!=',1)
           ->orderBy('id','DESC')
           ->first();
      //  dd($firstNews);
        $listLastNews = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','!=',1)
           ->orderBy('id','DESC')
           ->limit(7)->offset(1)->get();
        $listPostNewCorses = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','=',2)
           ->orderBy('id','DESC')
           ->limit(7)->offset(0)->get();
        $listPostActivities = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','=',3)
           ->orderBy('id','DESC')
           ->limit(7)->offset(0)->get();
        $listPostNews = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','=',4)
           ->orderBy('id','DESC')
           ->limit(7)->offset(0)->get();
    	return view('guest.index',
        ['lastNews'=>$lastNews,
        'listLastNews'=>$listLastNews,
        'listPostNewCourses'=>$listPostNewCorses,
        'listPostActivities' =>$listPostActivities,
        'listPostNews' => $listPostNews
        ]);

    }
    public function getViewPost($id, $slug)
    {
        $post = News::where('status','=','active')->findOrFail($id);
        return view('guest.viewpost',['post'=>$post]);
    }
    public function getListPost($id, $slug)
    {
        //$posts = News::where('status','=','active')->where('cate_id','=',$id)->get();
        $cate = NewsCategories::findOrFail($id);
        return view('guest.listpost',['cate'=>$cate]);
    }
    public function getListPostJson(Request $requst)
    {
        
    }
}
