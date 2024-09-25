<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\Card;
use App\Models\Front\Order;
use App\Models\Front\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Display orders
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->get();
        return view('orders.index', ['orders'=>$orders]);
    }

    // Place an order
    public function store(Request $request)
    {
        try{

        }catch(\Exception $e){
            

        }
        $card = Card::where('user_id', Auth::id())->firstOrFail();
        $items = $card->items()->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->back()->with('error', 'Your card is empty.');
        }

        $totalPrice = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Clear the card
        $card->items()->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }
}
