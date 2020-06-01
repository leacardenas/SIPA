<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\AgregarInsumo;

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

    public function pruebaFactura(Request $request){
            $factura = DB::table('sipa_insumos_facturas')->orderBy('sipa_facturas_id','desc')->first();
            $asociarInsumo = AgregarInsumo::where('sipa_ingreso_insumo',1)->orderBy('sipa_insumos_ingreso_id','desc')->first();
            dd($asociarInsumo->sipa_insumos_ingreso_id);
    }
}
