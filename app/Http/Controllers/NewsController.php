<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsAddRequest;
use App\Http\Requests;
use App\News;
use App\NewsCategories;
use App\Http\Requests\NewsEditRequest;

class NewsController extends Controller
{
    public function getListNewsAdmin()
    {
    	return view('admin.news.list');
    }
    public function getAddNewsAdmin()
    {
    	$cate = NewsCategories::where('status','=','active')->orWhere('status','=','system')
    	->get();
    	return view('admin.news.add',['cates'=>$cate]);
    }
    public function getEditNewsAdmin($id)
    {
        $cate = NewsCategories::where('status','=','active')->orWhere('status','=','system')
        ->get();
        $news = News::findOrFail($id);
        return view('admin.news.edit',['cates'=>$cate,'news'=>$news]);
    }

    function postEditNewsAdmin($id,NewsEditRequest $request)
    {
        $news = News::findOrFail($id);
        $news->title = $request->txtTitle;
        $news->cate_id = $request->sltCate;
        $news->description = $request->txtDescription;
        $news->content = $request->txtContent;
        $news->slug = str_slug($request->txtTitle, "-");
       
        $file = $request->file('fileImage');
     //   dd(strlen($file));
        if(strlen($file) >0){
            $filename = str_slug($request->txtTitle, "-").'-'.time().'_'.$file->getClientOriginalName();
            $destinationPath = 'upload/newsimages';
            $file->move($destinationPath,$filename);
            $news->image= $filename;
        }
        $news->save();
        $lastEditId =  $news->id;
        $url = "adminsites/news/detail/".$lastEditId;
        return redirect($url)
        ->with(['flash_level'=>'alert-success','flash_message' => 'Sửa bản tin thành công'] );

    }
    public function postAddNewsAdmin(NewsAddRequest $request){
    	$news = new News();
    	$news->title = $request->txtTitle;
    	$news->cate_id = $request->sltCate;
    	$news->description = $request->txtDescription;
    	$news->content = $request->txtContent;
    	$news->slug = str_slug($request->txtTitle, "-");
    	$news->status = 'active';
    	 $file = $request->file('fileImage');
     //   dd(strlen($file));
        if(strlen($file) >0){
            $filename = str_slug($request->txtTitle, "-").'-'.time().'_'.$file->getClientOriginalName();
            $destinationPath = 'upload/newsimages';
            $file->move($destinationPath,$filename);
            $news->image= $filename;
        }else{
        	$news->image= 'default.jpg';
        }
        $news->save();
        $lastInsertId =  $news->id;
        $url = "adminsites/news/detail/".$lastInsertId;
        return redirect($url)
        ->with(['flash_level'=>'alert-success','flash_message' => 'Đăng bản tin thành công'] );

    }
    public function getListNewsJson(Request $request)
    {
    	$keyword = $request->keyword;
    	$numberRecord= $request->max;
        $cateId =$request->cateid;
      
    	$page = $request->page;
        if($cateId == ""){
            $cateId = null;
        }
       
        $vitri =($page -1 ) * $numberRecord;
     //   $totalTeacher = Teacher::count();
    //    $numPages = $totalApp / $numberRecord +1;

           $data = News::
           join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.cate_id','news.description','news_categories.name','news.title','news.created_at','news.image')
            ->where('news.status','=','active')
            ->where(function($query) use ($keyword){
            $query->where('news.title','LIKE','%'.$keyword.'%');
            })
           
            ->where('news.cate_id','LIKE', $cateId)
            ->orderBy('news.id','DESC')->limit($numberRecord)->offset($vitri)->get();
        
    	return $data;
    }
    public function getTotalNewsJson(Request $request)
    {
        $cateId = $request->cateid;
        if($cateId == ""){
            $cateId = null;
        } 
    	return News::where('status','=','active')
        ->where('cate_id','LIKE',$cateId)
        ->count();
    }
    public function getDetailNewsAdmin($id)
    {
    	$news = News::join('news_categories','news_categories.id','=','news.cate_id')->findOrFail($id);
    	return view('admin.news.detail',['news'=> $news]);
    }
    public function getDeleteNews($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return "Xóa bài viết thành công";
    }
}
