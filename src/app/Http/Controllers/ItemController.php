<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('item/index', compact('items'));
    }

    public function show(Request $request)
    {
        $item = Item::find($request->item_id);

        return view('item/show', compact('item'));
    }
}
