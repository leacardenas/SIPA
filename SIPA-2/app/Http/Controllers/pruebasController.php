<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDF;
use App;
use DOMDocument;

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

    // public function pruebaFactura(Request $request){
    //         $factura = DB::table('sipa_insumos_facturas')->orderBy('sipa_facturas_id','desc')->first();
    //         $asociarInsumo = AgregarInsumo::where('sipa_ingreso_insumo',1)->orderBy('sipa_insumos_ingreso_id','desc')->first();
    //         dd($asociarInsumo->sipa_insumos_ingreso_id);
    // }

    public function crearPDF(){
        $html = view('pdfViews.comprobanteEntregas')->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        $pdf->setPaper('landscape');
        $content = $pdf->download()->getOriginalContent();
        $documento = base64_encode($content);
        dd($documento);
    }
}
