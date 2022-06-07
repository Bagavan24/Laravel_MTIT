<?php

namespace App\Http\Controllers;
use App\Models\orderline;
use App\Models\order;
use App\Models\product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Exception;

use Illuminate\Http\Request;

class OrderlineController extends Controller
{
    //
    public function Create(Request $req)        
    {
        try{
            $validator = Validator::make($req->all(),[
                'orderid' => 'required|integer|gt:0',
                'productid'=>'required|integer|gt:0',
                'quantity'=> 'required|integer|gt:0'
            ]);
        
    
            if($validator->fails()){
                return response([
                    'error' => $validator->errors(),
                    401
                ]);
            }

            $order = Order::find($req->orderid);
            if(is_null($order)){
                return response()->json('Order ID not found in database',404);
            }
            
            $product = Product::find($req->productid);
            if(is_null($product)){
                return response()->json('Product ID not found in database',404);
            }

            $product = $req->productid;
            $quantity = $req->quantity;
                
            $orderline = new Orderline;
            $orderline->orderid = $req->orderid;
            $orderline->productid = $req->productid;
            $orderline->quantity = $req->quantity;
      
            
            $result = $orderline->save();
    
            if($result)
            {
                return ["Result" => "orderline has been saved" ];
            }
            else
            {
                return ["Result" => "Operation Failed!!" ];
            }

            $products = $req->get('products');

            for ($i = 0; $i < 10; $i++)
            {
                $orderline = new Orderline;
                $orderline->orderid = $req->orderid[$i];
                $orderline->productid = $req->productid[$i];
                $orderline->quantity = $req->quantity[$i];
                $result = $orderline->save();

            if($result)
            {
                return ["Result" => "order has been saved" ];
            }
            else
            {
                return ["Result" => "Operation Failed!!" ];
            }
        }
        $arrays = array(
            'orderid' => $req->orderid,
            'productid' => $req->productid,
            'quantity' => $req->quantity
        );

    // loop through all products
    foreach ($arrays as $key=>$val) {
        Orderline::create([
            'orderid' => $val['orderid'],
            'productid' =>$val['productid'],
            'quantity' =>$val['quantity'],
        ]);
        
        echo "Data Inserted Successfully.";
    }


        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

        //get one value by ID
    public function ReadById($id)
    {
        try{
            $orderline =Orderline::find($id);
        if(is_null($orderline)){
            return response()->json('Record not found in database',404);
        }
        
        return response()->json($orderline);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
        //update orderline
    function Update(Request $req)
    {  
        
        try{
            $validator = Validator::make($req->all(),[
                'orderid' => 'required|integer|gt:0',
                'productid'=>'required|integer|gt:0',
                'quantity'=> 'required|integer|gt:0'
            ]);
    
            if($validator->fails()){
                return response([
                    'error' => $validator->errors(),
                    401
                ]);
            }
            $orderline =Orderline::find($req->id);
            if(is_null($orderline)){
                return response()->json('Record not found in database',404);
            }

            $order = Order::find($req->orderid);
            if(is_null($order)){
                return response()->json('Order ID not found in database',404);
            }
            
            $product = Product::find($req->productid);
            if(is_null($product)){
                return response()->json('Product ID not found in database',404);
            }

            $orderline->orderid = $req->orderid;
            $orderline->productid = $req->productid;
            $orderline->quantity = $req->quantity;

            $result = $orderline->save();
    
            if($result)
            {
                return ["Result" => "order has been updated" ];
            }
            else
            {
                return ["Result" => "Operation Failed!!" ];
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

        //Delete Order
    function Delete($id)
    {
        try{
            $order = order::find($id);
            if(is_null($order))
            {
                return ["result" => "record not found!!!", 404]; 
            }
            $result = $order->delete();
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
