<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use Session;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->Session()->put('cart', $cart);
        return redirect()->route('home');
    }

    public function getCart()
    {
        if(!Session::has('cart')) {
            return view('cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if(count($cart->items) > 0) {
            Session::put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }
        return redirect()->route('Cart');
    }

    public function getDropItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->dropItem($id);

        if(count($cart->items) > 0) {
            Session::put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }
        return redirect()->route('Cart');
    }

    public function getCheckout($value='')
    {
        if(!Session::has('cart')){
            return view('cart');
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        $total = $cart->totalPrice;
        return view('checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
        if(!Session::has('cart')) {
            return redirect()->route('Cart');
        }
            $oldcart = Session::get('cart');
            $cart = new Cart($oldcart);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                Customer::create([
                  'name' => $request->name,
                  'address' => [
                    'line1' => $request->address_line_1,
                    'postal_code' => $request->zip,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                  ],
                ]);

                $charge= Charge::create([
                  "amount" => $cart->totalPrice * 100,
                  "currency" => "inr",
                  "source" => "tok_mastercard", // obtained with Stripe.js
                  "description" => "My First Test Charge (created for API docs)"
                ]);

                $order = new Order();
                $order->name = $request->name;
                $order->user_id = Auth::user()->id;
                $order->payment_id = $charge->id;
                $order->address = $request->address_line_1;
                $order->cart = serialize($cart);
                
                Auth::user()->orders()->save($order);
            }
            catch (\Exception $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            }  

            Session::forget('cart');
            return redirect()->route('Cart')->with('success', 'Product Successfully purchased');
    }
}
