<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller {

    public function viewCart() {
        // $cart_items = Session::get('cart_items');
        // return view('cart.index', compact('cart_items'));
        return view('cart.index');
    }
    
    // public function addToCart($id) {

    //     $product = Product::find($id);
        
    //     $cart_items = Session::get('cart_items');
    //     if(is_null($cart_items)) {
    //         $cart_items = array();
    //     }
        
    //     $qty = 0;
    //     if(array_key_exists($product->id, $cart_items)) {
    //         $qty = $cart_items[$product->id]['qty'];
    //     }
        
    //     $cart_items[$product['id']] = array( 'id' => $product->id,
    //         'code' => $product->code,
    //         'name' => $product->name,
    //         'price' => $product->price,
    //         'image_url' => $product->image_url,
    //         'qty' => $qty + 1
    //     );
    //     Session::put('cart_items', $cart_items);

    //     return redirect('cart/view');

    // }


    // public function updateCart($id, $qty) {
        
    //     $cart_items = Session::get('cart_items');
        
    //     $cart_items[$id]['qty'] = $qty;
    //     if ($qty <= 0) {
    //         unset($cart_items[$id]);
    //     }

    //     Session::put('cart_items', $cart_items);

    //     return redirect('cart/view');
        
    // }

    // public function deleteCart($id) {
    //     $cart_items = Session::get('cart_items');
        
    //     $cart_items[$id]['qty']--;
    //     if ($cart_items[$id]['qty'] <= 0) {
    //         unset($cart_items[$id]);
    //     }

    //     Session::put('cart_items', $cart_items);

    //     return redirect('cart/view');
    // }


    // Chapter 11 report
    public function checkOut() {
        // $cart_items = Session::get('cart_items');
        // $cart_items = json_encode('[{"id":2,"code":"P02","name":"pd2","category_id":2,"price":"2000","stock_qty":"24","image_url":"upload\\images/Islabikes-Beinn20-Small-Teal-ChildrensBike.webp","created_at":"2022-09-27T02:15:56.000000Z","updated_at":"2022-09-27T02:15:56.000000Z","$$hashKey":"object:4","qty":2},{"id":4,"code":"P04","name":"pd4","category_id":2,"price":"28000","stock_qty":"6","image_url":"upload\\images/images.jpg","created_at":"2022-09-27T02:19:26.000000Z","updated_at":"2022-09-27T02:19:26.000000Z","$$hashKey":"object:6","qty":2},{"id":5,"code":"P05","name":"pd5","category_id":2,"price":"20000","stock_qty":"5","image_url":"upload\\images/16065-team-xf-29-factory-racing-matte-carbon-chrome-team-red--410x250.jpg","created_at":"2022-09-27T02:19:58.000000Z","updated_at":"2022-09-27T02:19:58.000000Z","$$hashKey":"object:7","qty":2}]');
        // return view('cart/checkout', compact('cart_items'));
        return view('cart.checkout');
    }

    public function complete(Request $body) {
        
        $order_no = 'ORD' . date('YmdHis') . rand(1000, 9999);
        $order_date = date('d-m-Y H:i:s');

        $cust_name = $body->cust_name;
        $cust_email = $body->cust_email;
        $total_price = 0;

        $dataCart = json_decode($body->jsonDataCart);
        foreach ($dataCart  as $item) {
            $item->total = $item->qty * $item->price;
            $total_price += $item->total;
        }
        
        $html_output = view('cart.complete', 
            compact(
                'dataCart', 'cust_name', 'cust_email', 'total_price',
                'order_no', 'order_date'
            )
        )->render();
        
        $mpdf = new \Mpdf\Mpdf();
        
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output('output.pdf', 'i');

        return $resp->withHeader("Content-type", "application/pdf");
    
    }


    public function finish(Request $body) {
        
        //call function create() in OrderController.php 
        $order_ref = app('App\Http\Controllers\OrderController')->create($body);

        // Clear item in cart
        echo "<script> localStorage.clear(); </script>";
        
        return view('cart.finish_order', compact('order_ref'));
    }



}
