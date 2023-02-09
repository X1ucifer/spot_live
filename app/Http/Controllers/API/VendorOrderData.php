<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VendorOrderData extends Controller
{
    //
    public function index(Request $request)
    {

        $vendor_id = $request->vendor_id;
        $date = $request->date;

        $order = DB::table('orders')->select('*')
        ->where("vendor_id",$vendor_id)
        ->whereDate('created_at', $date)->get();
        // $vendor = $order-;


        return response()->json([
           "data"=> $order,
           "date"=>$date,
           "vendor_id"=>$vendor_id,
        ], 200);
    }
}
