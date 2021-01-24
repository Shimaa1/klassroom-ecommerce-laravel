<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use App\Notifications\OrderEmailNotification;

class CartController extends Controller
{
    public function showCart()
    {
        $data = [];
        $data['total'] = 0;
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'],'total_price'));
        return view('frontend.cart',$data);

    }

    public function addToCart(Request $request)
    {
        $cart = [];

        try {
            $this->validate($request,[
                'product_id' => 'required|numeric',
            ]);
        }catch (ValidationException $e){
            return redirect()->back();
        }

        $product = Product::findOrFail($request->input('product_id'));
        $unit_price = ($product->sale_price !== null && $product->sale_price > 0) ? $product->sale_price : $product->price;
        $cart = session()->has('cart') ? session()->get('cart') : [];



        if (array_key_exists($product->id, $cart)){
            //die('Product already added.');
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_price'] = $cart[$product->id]['unit_price'] * $cart[$product->id]['quantity'];
        }else{
            $cart[$product->id] = [
                'title' => $product->title,
                'quantity' => 1,
                'unit_price' => $unit_price,
                'total_price' => $unit_price ,
            ];
        }


        session(['cart' => $cart]);

        session()->flash('message',$product->title.' added to cart.');

        return redirect()->route('cart.show');

    }

    public function removeFromCart(Request $request){
        $cart = [];

        try {
            $this->validate($request,[
                'product_id' => 'required|numeric',
            ]);
        }catch (ValidationException $e){
            return redirect()->back();
        }

        $cart = session()->has('cart') ? session()->get('cart') : [];

        unset($cart[$request->product_id]);

        session(['cart' => $cart]);

        session()->flash('message','Product removed to cart.');

        return redirect()->route('cart.show');
    }

    public function clearCart()
    {
        session(['cart' => []]);

        return redirect()->back();

    }

    public function checkout()
    {
        $data = [];
        $data['total'] = 0;
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'],'total_price'));
        return view('frontend.checkout',$data);
    }

    public function processOrder(Request $request)
    {
        $this->validate($request,[
            'customer_name' => 'required',
            'customer_phone_number' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);
       
        
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $total = array_sum(array_column($cart,'total_price'));

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'customer_name' => $request->customer_name, 
            'customer_phone_number' => $request->customer_phone_number, 
            'address' => $request->address, 
            'city' => $request->city, 
            'postal_code' => $request->postal_code, 
            'total_amount' => $total, 
            'paid_amount' => $total,
            'payment_details' => 'Cash on Delivery',
        ]);

        foreach ($cart as $product_id => $product) {
            $order->products()->create([
                'product_id' => $product_id,
                'quantity' => $product['quantity'],
                'price' => $product['total_price'],
            ]);
        }

        auth()->user()->notify(new OrderEmailNotification($order,auth()->user(0)));

        session()->forget(['cart']);
        session()->flash('message','Order placed successfully.');

        //$this->setSuccess('Order placed successfully.');
        return redirect()->route('order.details',$order->id);
    }

    public function showOrder($id)
    {
        $data = [];
        
        $data['order'] = Order::with('products.product')->findOrFail($id);

        return view('frontend.orders.details',$data);
    }





}
