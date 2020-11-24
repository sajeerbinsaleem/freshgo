<?php

namespace App\Http\Controllers\admin_panel;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop;
use App\ShopCategory;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $result = Category::where('category_type','shop')->get();
        return view('admin_panel.shops.create')
            ->with('catlist', $result);
    }
    public function createShopCategory()
    {
        $result = Category::where('category_type','shop')->get();
        return view('admin_panel.shopCategory.create')
            ->with('catlist', $result);
    }
    public function store(Request $request)
    {
        $shop = $request->shop;
        $files =$request->file('files');
        $shop = json_decode($shop);
            $image = '';
            foreach($files as $file){
                // $file = $request->file('file');
                $file_name ='freshgo'.'/'.time().'file.'.$file->getClientOriginalExtension();
                Storage::disk('s3')->put($file_name, file_get_contents($file), 'public');
                $image = Storage::disk('s3')->url($file_name);
                $image = $image.','.$image;
            }
        $cartegory = new Shop;
        $cartegory->name = $shop->name;
        $cartegory->shope_image = $image;
        $cartegory->latitude = $shop->lat;
        $cartegory->longitude = $shop->lng;
        $cartegory->phone = isset($shop->phone)?$shop->phone :''; 
        $cartegory->email = isset($shop->email)?$shop->email :''; 
        $cartegory->description = isset($shop->description)?$shop->description :'';
        $cartegory->save();
        foreach($shop->category as $category){
            $cat = new ShopCategory;
            $cat->shop_id = $cartegory->id;
            $cat->category_id = $category;
            $cat->save();
        }
        
        return response([
            'message' => 'success',
            'shop'    => $cartegory,
 
        ],200);
    }
    public function postShopCategory(Request $request)
    {
        // return $request->all();

        $validatedData = $request->validate([
            'file' => 'mimes:jpeg,jpg,png|max:12000',
            'name' => 'required|max:255',
            'category_type' => 'required',
        ]);
        $image = '';
        if($request->has('file')){
            $file = $request->file('file');
            $file_name ='freshgo'.'/'.time().'file.'.$file->getClientOriginalExtension();
            Storage::disk('s3')->put($file_name, file_get_contents($request->file('file')), 'public');
            $image = Storage::disk('s3')->url($file_name);
        }

        $cartegory = new Category;
        $cartegory->name = $request->name;
        $cartegory->description = $request->description;
        $cartegory->parent_id = $request->has('parent_id')? $request->parent_id : 0;
        $cartegory->category_type = $request->category_type;
        $cartegory->img_url = $image;
        $cartegory->save();
        return redirect()->back()->with(['message' => 'successfully saved']);
       

    
    }
}
