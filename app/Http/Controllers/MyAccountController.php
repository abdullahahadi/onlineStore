<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    
    public function orders() {

        $viewData = [];
        $viewData["title"] = "My Orders - Online Store";
        $viewData["subtitle"] = "My Orders";
        //eager loading using the `with` method.
        $viewData["orders"] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->get();
        // $viewData["orders"] = Order::Where('user_id', Auth::user()->id)->get();

        return view('myaccount.orders')->with("viewData",$viewData);
    }

}
