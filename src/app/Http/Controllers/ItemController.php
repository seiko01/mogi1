<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('index', compact('items'));
    }
public function show($itemId)
{
    $item = Item::with('category', 'condition', 'comments.user')->findOrFail($itemId);
    return view('show', compact('item'));
}
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions'));
    }

    public function store(Request $request)
    {

        $item = new Item();
        $item->user_id = Auth::id();
        $item->name = $request->name;
        $item->brand_name = $request->brand_name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id = $request->category_id;
        $item->condition_id = $request->condition_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $item->image = $path;
        }
        $item->save();

        return redirect()->route('items.index');
    }
}
