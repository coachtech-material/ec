<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function index()
    {
        $cart_items = CartItem::userSearch()->get();

        $subtotal = 0;
        foreach ($cart_items as $cart_item) {
            $subtotal += $cart_item->item->price * $cart_item->quantity;
        }

        return view('cart_item/index', compact('cart_items', 'subtotal'));
    }

    public function store(CartItemRequest $request)
    {
        CartItem::updateOrCreate(
            ['item_id' => $request->item_id, 'user_id' => Auth::id()],
            ['quantity' => $request->quantity]
        );

        return back()->with('message', 'カートに追加しました');
    }

    public function update(CartItemRequest $request)
    {
        $cart_item = $request->only(['quantity']);

        CartItem::find($request->cart_item_id)->update($cart_item);

        return back()->with('message', 'カートを更新しました');
    }

    public function destroy(Request $request)
    {
        CartItem::find($request->cart_item_id)->delete();

        return back()->with('message', 'カートから削除しました');
    }
}
