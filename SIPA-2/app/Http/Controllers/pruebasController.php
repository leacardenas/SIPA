<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class pruebasController extends Controller
{
//     public function downloadOrderInvoice($id) {
//         $order          = Order::find($id);
//         $customer       = Customer::find($order->customer_id);
//         $shipping       = Shipping::find($order->shipping_id);
//         $orderDetails   = OrderDetail::where('order_id', $order->id)->get();

//         $pdf = PDF::loadView('test',[
//             'order'=> $order,
//             'customer'=>$customer,
//             'shipping'=>$shipping,
//             'orderDetails'=>$orderDetails
//         ]);

//         return $pdf->download('invoice.pdf');
// //        return $pdf->stream('invoice.pdf');
//     }
}
