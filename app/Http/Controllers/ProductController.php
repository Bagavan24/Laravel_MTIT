<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Exception;

class ProductController extends Controller
{
    //
    //get all values
    public function productRead()
    {
        try{
            return product::all();
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
  

    //get one value by ID
    public function productReadById($id)
    {
        try{
            $product =Product::find($id);
        if(is_null($product)){
            return response()->json('Record not found in database',404);
        }
        
        return response()->json($product);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    // create products
    public function productCreate(Request $req)
    {
        try{
            $validator = Validator::make($req->all(),[
                'productname' => 'required|alpha',
                'buyprice' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                'sellprice' =>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'quantity' =>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'discount' =>['required','regex:/^\d+(\.\d{1,2})?$/'],          
            ]);
    
            if($validator->fails()){
                return response([
                    'error' => $validator->errors(),
                    401
                ]);
            }
            
            $product = new Product;
            $product->productname = $req->productname;
            $product->buyprice = $req->buyprice;
            $product->sellprice = $req->sellprice;
            $product->quantity = $req->quantity;
            $product->discount = $req->discount;
            $result = $product->save();
            if($result)
            {
                return ["Result" => "Data has been saved "];
    
            }
            else
            {
                return ["Result" => "Operation Failed!! "];
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //update products
    function productUpdate(Request $req)
    {
        try{
            $validator = Validator::make($req->all(),[
                'productname' => 'required|alpha',
                'buyprice' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                'sellprice' =>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'quantity' =>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'discount' =>['required','regex:/^\d+(\.\d{1,2})?$/'],
            ]);
    
            if($validator->fails()){
                return response([
                    'error' => $validator->errors(),
                    401
                ]);
            }
            
            $product =Product::find($req->id);
            if(is_null($product)){
                return response()->json('Record not found in database',404);
            }
    
            $product->productname = $req->productname;
            $product->buyprice = $req->buyprice;
            $product->sellprice = $req->sellprice;
            $product->quantity = $req->quantity;
            $product->discount = $req->discount;

            $result = $product->save();
            if($result){
                return response([
                  
                    'message'=>'Product Successfully updated'
                ]);
            }
            else{
                return response([
                  
                    'message'=>'Update Operation failed'
                ]);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //delete product
    function productDelete($id)
    {
        try{
            $product = product::find($id);
            if(is_null($product))
            {
                return ["result" => "record not found!!!", 404]; 
            }
            $result = $product->delete();
            if($result)
            {
                return ["result" => "record has been deleted"]; 
            }
            else
            {
                return ["result" => " Delete operation has been failed"];
    
            }
            
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
