<?php

namespace App\Http\Controllers;

use App\Wishlist;
use App\Wishlist_Item;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function addItem ($varianceId)
	{
		$wishlist = Wishlist::where('user_id',Auth::user()->id)->first();
 
        if(!$wishlist){
            $wishlist =  new Wishlist();
            $wishlist->user_id=Auth::user()->id;
            $wishlist->save();
        }
 
        $wishItem  = new Wishlist_Item();
        $wishItem->variance_id=$varianceId;
        $wishItem->wishlist_id= $wishlist->id;
        $wishItem->save();
 
        return redirect('/wishlist');
 
    }

    public function showList() {
        $wishlist = Wishlist::where('user_id',Auth::user()->id)->first();

        if(!$wishlist){
            $wishlist =  new Wishlist();
            $wishlist->user_id=Auth::user()->id;
            $wishlist->save();
        }
 
        //$items = $cart->cartItems;
		    $items = Wishlist_Item::where('wishlist_id', $wishlist->id)->get();

        $total=0;
        foreach($items as $item){
             	$total+=$item->variance->price;
          //dd($item->variance->price);
        }
        		//dd($items);
        

 
        return view('wishlist', ['total'=>$total])->with('items', $items);

    }

    public function removeWish($itemId){
            //dd($itemId);
 
        Wishlist_Item::destroy($itemId);
        return redirect('/wishlist');
    }
}