<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(){
        $this->category = new Category();
    }
    public function getCategory(){

        try{
            $categories = $this->category->select('id','name')->where('sts','active')->orderBy('id', 'desc')->get();
            if(!count($categories) > 0){
                return response()->json(['output'=>'failed','message'=>'categories not found !','categories'=>$categories],404);die();
            }
            return response()->json(['output'=>'success','message'=>'categories found !','categories'=>$categories],200);

        }
        catch(Exception $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()],404);
        }
        
    }
    public function addCategory(Request $request){
        try{
            $validate = $request->validate([
                'name'=>'required|string|min:3|alpha_dash'
            ],[
                'name.required'=>'category name is required',
                    'name.string'=>'category name should be alphanumeric',
                    'name.min'=>'category name shoulb be min length of 3',
                    'name.alpha_dash'=>'only alpha numeric dash or underscore allowed,spaces are not allowed.',
            ]
            );
            $this->category->name = strip_tags($validate['name']);
            $cat = $this->category->save();
            return response()->json(['status'=>'success','message'=>'category added'],201);
        }
        catch(ValidationException $e){
            
            return response()->json(['output'=>'failed','error'=>$e->validator->errors()],422);
        }
        catch(Exception $e){
            return response()->json(['output'=>'failed','error'=>$e->getMessage()]);
        }

    }
}
