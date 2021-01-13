<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductImage;
use App\Shop;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class ApiController extends Controller
{   
   /**
    * nearShops
    *
    * @param  mixed $km
    * @return void
    */
   public function nearShops(Request $request)
   {
    
        $validator = \Validator::make($request->all(), [
            'latitude' => 'required | numeric',
            'longitude' => 'required | numeric',
            'radius' => 'required | numeric',
           
        ]);
        if ($validator->fails()) {
            $responseArr['status'] = 'error';
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr, 422);
        }
        // return round(Shop::distance(11.6136614,76.0851692,11.2586082,75.7788735,'K'));
        if($request->has('radius')){
            $shops = Shop::all();
            $shop_array = [];
            foreach($shops as $shop){
                // $shop->distance = round($this->distance(11.6136614,76.0851692,$shop->latitude,$shop->longitude,'K'));
                $shop->distance = round($this->distance($request->latitude,$request->longitude,$shop->latitude,$shop->longitude,'K'));
                if($shop->distance <= $request->radius){
                    array_push($shop_array,$shop);
                }
            }
            return response(['status' => 'ok','data' => $shop_array],200);
        }
    

   }   
   /**
    * get products
    *
    * @param  mixed $request
    * @return void
    */
   public function products(Request $request)
   {
        $validator = \Validator::make($request->all(), [
            'shopIds' => ' array',
            'shopId' => ' numeric',
            'categoryIds' => ' array',
            'categoryId' => ' numeric',
        
        ]);
        if ($validator->fails()) {
            $responseArr['status'] = 'error';
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr, 422);
        }
        if($request->has('shopIds')){
                $data = DB::table('product_shops')
                ->join('products','product_shops.product_id','=','products.id')
                ->whereIn('shop_id',$request->shopIds)->get();
        }
        else if($request->has('shopId')){
            $data = DB::table('product_shops')
            ->join('products','product_shops.product_id','=','products.id')
            ->where('shop_id',$request->shopId)->get();
        }
        else if($request->has('categoryIds')){
            $data = DB::table('product_categories')
            ->join('products','product_categories.product_id','=','products.id')
            ->whereIn('category_id',$request->categoryIds)->get();
        }
        else if($request->has('categoryId')){
            $data = DB::table('product_categories')
            ->join('products','product_categories.product_id','=','products.id')
            ->where('category_id',$request->categoryId)->get();
        } else{
            return response(['status' => 'error','message'=>'please provide any of params shopId,shopIds,categoryId, catgoryIds etc..!'],422);
        }

       return response(['status' => 'ok','data'=>$data],200);
   } 
      
   /**
    * productImages
    *
    * @param  mixed $request
    * @return void
    */
   public function productImages(Request $request)
   {
        $validator = \Validator::make($request->all(), [
            'productId' => 'required | numeric',
        
        ]);
        if ($validator->fails()) {
            $responseArr['status'] = 'error';
            $responseArr['message'] = $validator->errors();
            return response()->json($responseArr, 422);
        }
        $data = ProductImage::where('product_id',$request->productId)->get();
        return response(['status' => 'ok','data'=>$data],200);
   }
   
   /**
    * categories
    *
    * @param  mixed $request
    * @return void
    */
   public function categories(Request $request)
   {
        
        $data = Category::where('parent_id',0)
        ->select('id','name','img_url', 'category_type as type','description')
        ->with('subcategories:id,parent_id,name,img_url,category_type as type')->get();
        return response(['status' => 'ok','data'=>$data],200);
   }   
   /**
    * category
    *
    * @param  mixed $id
    * @return void
    */
   public function category($id)
   {
        
        $data = Category::where('id',$id)
        ->select('id','name','img_url', 'category_type as type','description')
        ->with('subcategories:id,parent_id,name,img_url,category_type as type')->first();
        return response(['status' => 'ok','data'=>$data],200);
   }   
   /**
    * shops
    *
    * @param  mixed $request
    * @return void
    */
   public function shops(Request $request)
   {
        
        $data = Shop::get();
        return response(['status' => 'ok','data'=>$data],200);
   }   
   /**
    * shop
    *
    * @param  mixed $id
    * @return void
    */
   public function shop($id)
   {
        $data = Shop::where('id',$id)->first();
        return response(['status' => 'ok','data'=>$data],200);
   }
    /**
     * distance
     *
     * @param  mixed $lat1
     * @param  mixed $lon1
     * @param  mixed $lat2
     * @param  mixed $lon2
     * @param  mixed $unit[K=>KM, N=>notikal mile]
     * @return void
     */
    public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
        }
        else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
    
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
        }
    }
}
