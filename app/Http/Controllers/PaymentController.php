<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Models\payment;
use App\Models\order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //create Payment
    public function create(Request $req)
    {
        try{
            $validator = Validator::make($req->all(),[
                'orderid' => 'required|integer',
                'status'=>'required|string'
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
    
            $payment = new Payment;
            $payment->orderid = $req->orderid;
            $payment->status = $req->status;

            $result = $payment->save();
    
            if($result)
            {
                return ["Result" => "Payment has been created!!!" ];
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

        //get one value by ID
    public function ReadById($id)
    {
        try{
            $payment =Payment::find($id);
        if(is_null($payment)){
            return response()->json('Record not found in database',404);
        }
        
        return response()->json($payment);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

        //update Payment
    function Update(Request $req)
    {
        try{
            $validator = Validator::make($req->all(),[
                'orderid' => 'required|integer',
                'status'=>'required|string'
            ]);
    
            if($validator->fails()){
                return response([
                    'error' => $validator->errors(),
                    401
                ]);
            }
    
            $payment =Payment::find($req->id);
                if(is_null($payment)){
                    return response()->json('Record not found in database',404);
                }

            $order = Order::find($req->orderid);
                if(is_null($order)){
                    return response()->json('Order ID not found in database',404);
                }
    
                $payment->orderid = $req->orderid;
                $payment->status = $req->status;
    
                $result = $payment->save();
        
                if($result)
                {
                    return ["Result" => "Payment has been updated" ];
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

        //Delete Payment 
    function Delete($id)
    {
        try{
            $payment = Payment::find($id);
            if(is_null($payment))
            {
                return ["result" => "record not found!!!", 404]; 
            }
            $result = $payment->delete();
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
