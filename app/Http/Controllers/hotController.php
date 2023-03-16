<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\hotProduct;

use App\Models\product;

class hotController extends Controller
{
    public function index()
    {
        return view('hot.index');
    }

    public function hotOrderProduct(Request $request)
    {
        $id = $request->product_id;

        $order = $request->val;

        $hot = hotProduct::find($id);

        $product  = product::find($hot->product_id);

        $product->orders_hot =$order;

        $product->save();

        $hot->orders = $order;

        $hot->save();

    }
}
