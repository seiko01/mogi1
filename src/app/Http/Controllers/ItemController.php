<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
            return view('index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        dd($conditions);
        return view('sell', compact('categories', 'conditions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'category_id' => 'required',
            'condition_id' => 'required',
            'image' => 'nullable|image'
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->brand = $request->brand;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id = $request->category_id;
        $item->condition_id = $request->condition_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $item->image = $path;
        }

        $item->save();
        return redirect()->route('items.index')->with('success', '商品を出品しました');
    }
}