<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Exception;

class OrderController extends Controller
{
        //create order
        public function create(Request $req)
        {
            try{
                $date = Carbon::now();
                $validator = Validator::make($req->all(),[
                    'totalamount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                    'paymenttype' =>'required|alpha',
                ]);
                if($validator->fails()){
                    return response([
                        'error' => $validator->errors(),
                        401
                    ]);
                }
        
                $order = new Order;
                $order->orderdate = $date;
                $order->totalamount = $req->totalamount;
                $order->paymenttype = $req->paymenttype;
                $result = $order->save();
        
                if($result)
                {
                    return ["Result" => "Order has been saved!!"];
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
    
    
            //get one value by ID
        public function ReadById($id)
        {
            try{
                $order =Order::find($id);
            if(is_null($order)){
                return response()->json('Record not found in database',404);
            }
            
            return response()->json($order);
            }
            catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    
            //get all values
            public function Read()
        {
            try{
                return order::all();
            }
            catch (\Exception $e) {
    
                return $e->getMessage();
            }
            
        }
    
            //update order
        function Update(Request $req)
        {
            try{
                $date = Carbon::now();
                $validator = Validator::make($req->all(),[
                    'totalamount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                    'paymenttype' =>'required|alpha',
                ]);
        
                if($validator->fails()){
                    return response([
                        'error' => $validator->errors(),
                        401
                    ]);
                }
                $order =Order::find($req->id);
                if(is_null($order)){
                    return response()->json('Record not found in database',404);
                }
    
                $order->orderdate = $date;
                $order->totalamount = $req->totalamount;
                $order->paymenttype = $req->paymenttype;
                $result = $order->save();
        
                if($result)
                {
                    return ["Result" => "order has been updated"];
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
