<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    protected $product;
    public function __construct(){
        $this->product = new Product();
    }
    public function addProduct(Request $request){
        try{
            $validate = $request->validate([
                'name'=>'required|string',
                'price'=>'required|integer',
                'category_id'=>'required|integer'
            ],[
                'name.required'=>'product name is required',
                'name.string'=>'product name only letters and numbers allowed',
                'price.required'=>'product price is required',
                'price.integer'=>'price contain only numbers',
                'category_id.required'=>'category id is required',
                'category_id.integer'=>'category id must be integer'
            ]);
            $this->product->name = strip_tags($validate['name']);
            $this->product->price = strip_tags($validate['price']);
            $this->product->category_id = strip_tags($validate['category_id']);
            $data = $this->product->save();
            if(!@$data){
                return response()->json(['output'=>'failed','message'=>'error occurred'],500);
            }
            return response()->json(['output'=>'success','message'=>'product added'],201);
        }
        catch(ValidationException $e){
            return response()->json(['output'=>'failed','error'=>$e->validator->errors()],422);
        }
        catch(Exception $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()],500);
        }
    }
    public function getProducts(){
        try{
            $products = $this->product->select('id','name','price','category_id','qty')->where('sts','active')->get(); 
            if(!count($products) > 0){
                return response()->json(['output'=>'failed','error'=>'products not found']);
            }
            return response()->json(['output'=>'success','message'=>'products found','products'=>$products],200);
        }catch(\Throwable $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()],500);
        }
        catch(Exception $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()],500);
        }

    }
    public function getProduct($id = null){
        try{
            $product = $this->product->select('id','name','price','category_id','qty')->where('sts','active')->find($id);

            if(!$product){
                return response()->json(['output'=>'failed','error'=>'product not found']);
            }
            return response()->json(['output'=>'success','message'=>'product found','product'=>$product],200);
            
        }catch(\Throwable $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()],500);
        }
        catch(\Exception $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()],500);
        }
    }
}
