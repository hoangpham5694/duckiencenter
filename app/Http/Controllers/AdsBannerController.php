<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AdsBanner;
class AdsBannerController extends Controller
{
    public function getListAdsBannerAdmin()
    {
    	//$ads = AdsBanner::select('id,name,url,created_at')->get();
    	return view('admin.adsbanners.list');

    }
    public function getListAdsBannerJson(Request $request)
    {
    	$keyword = $request->keyword;
    	$numberRecord= $request->max;
        
      
    	$page = $request->page;
		$vitri =($page -1 ) * $numberRecord;

    	$ads = AdsBanner::select('id','name','image','url','created_at')
    	->where(function($query) use ($keyword){
            $query->where('name','LIKE','%'.$keyword.'%')
            ->orWhere('url','LIKE','%'.$keyword.'%');
        })
    	 ->orderBy('id','DESC')->limit($numberRecord)->offset($vitri)
    	 ->get();
    	return $ads;
    }
    public function getTotalAdsBannerJson()
    {
    	return AdsBanner::count();
    }
    public function getAddAdsBannerAdmin()
    {
    	return view('admin.adsbanners.add');
    }
    public function postAddAdsBannerAdmin(Request $request){
    	$ads = new AdsBanner();
    	$ads->name = $request->txtName;
    	$file = $request->file('fileImage');
     //   dd(strlen($file));
        if(strlen($file) >0){
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'upload/adsimages';
            $file->move($destinationPath,$filename);
            $ads->image= $filename;
        }
        $ads->url = $request->txtUrl;
        $ads->save();
        return redirect('adminsites/ads/list')->with(['flash_level'=>'alert-success','flash_message' => 'Thêm banner thành công'] );
    }
    public function getDeleteAdsBannerAdmin($id)
    {
    	$ads = AdsBanner::findOrFail($id);
    	$ads->delete();
    	return "Xóa thành công";

    }
    public function getEditAdsBannerAdmin($id)
    {
    	$ads = AdsBanner::findOrFail($id);
    	return view('admin.adsbanners.edit',['ads'=>$ads]);
    }
    public function postEditAdsBannerAdmin($id,Request $request){
    	$ads = AdsBanner::findOrFail($id);
    	$ads->name = $request->txtName;
    	$file = $request->file('fileImage');
     //   dd(strlen($file));
        if(strlen($file) >0){
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'upload/adsimages';
            $file->move($destinationPath,$filename);
            $ads->image= $filename;
        }
        $ads->url = $request->txtUrl;
        $ads->save();
        return redirect('adminsites/ads/list')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa banner thành công'] );
    }

}
