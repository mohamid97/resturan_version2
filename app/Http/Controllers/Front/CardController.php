<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StoreCard;
use App\Http\Requests\Front\UpdateCard;
use App\Models\Front\Card;
use App\Models\Front\CardItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    // Display the card
    public function index()
    {
        // Get the user's card, or create a new one if it doesn't exist
        $card = Card::firstOrCreate(['user_id' => Auth::id()]);

        // Load the card items with the related product information
        $items = $card->items()->with('product')->get();

        return view('cards.index', compact('card', 'items'));
    }


    // Add item to the card
    public function add(StoreCard $request)
    {
        try{

            DB::beginTransaction();
            $card = Card::firstOrCreate(['user_id' => Auth::id()]);
            $cardItem = $card->items()->where('product_id', $request->product_id)->first();
            if (isset($cardItem)) {
                $cardItem->quantity += $request->quantity;
                $cardItem->save();
            } else {
                $card->items()->create([
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]);
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Product added to card.');

        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage() , $e->getLine());

        }


    } // end function add card in item


    // Update item in the card
    public function update(UpdateCard $request, $id)
    {

        try{
            DB::beginTransaction();
            $cardItem = CardItem::findOrFail($id);
            $cardItem->quantity = $request->quantity;
            $cardItem->save();
            DB::commit();
            return redirect()->back()->with('success', 'Card updated.');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage() , $e->getLine());

        }

    }




     // Remove item from the card
    public function remove($id)
    {
        try{
            $cardItem = CardItem::findOrFail($id);
            $cardItem->delete();
            return redirect()->back()->with('success', 'Product removed from card.');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage() , $e->getLine());
        }

    } // end delete function



}
