<?php

namespace App\Http\Controllers\admin_panel;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop;
use App\ShopBanner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $result = Shop::get();
        return view('admin_panel.banner.create')
            ->with('shops', $result);
    }    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $banner = $request->banner;
        $files =$request->file('files');
        $banner = json_decode($banner);
            $image = '';
            foreach($files as $file){
                // $file = $request->file('file');
                $file_name ='freshgo'.'/'.time().'file.'.$file->getClientOriginalExtension();
                Storage::disk('s3')->put($file_name, file_get_contents($file), 'public');
                $image = Storage::disk('s3')->url($file_name);
                $image = $image.','.$image;
            }
        $cartegory = new Banner();
        $cartegory->name = $banner->name;
        $cartegory->banner_image = $image;
        $cartegory->type = isset($banner->type)?$banner->type :'main'; 
        $cartegory->description = isset($banner->description)?$banner->description :'';
        $cartegory->save();
        foreach($banner->category as $category){
            $cat = new ShopBanner();
            $cat->shop_id = $cartegory->id;
            $cat->banner_id = $category;
            $cat->save();
        }
        
        return response([
            'message' => 'success',
            'shop'    => $cartegory,
 
        ],200);
    }
}
