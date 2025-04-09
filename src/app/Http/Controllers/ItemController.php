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
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        if ($request->tab === 'recommend') {
            $items = Item::whereNull('user_id')
                ->orWhere('user_id', '!=', $user->id)
                ->get();
        } else {
            $items = $user->likes()->with('item')->get()->pluck('item');
        }

        return view('index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::with(['comments.user', 'likes'])->findOrFail($id);

        $user = auth()->user();
        $isLiked = false;

        if ($user) {
            $isLiked = $item->likes->contains('user_id', $user->id);
        }

        return view('show', compact('item', 'isLiked'));
    }

    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_ids' => 'required|array',
                'category_ids.*' => 'exists:categories,id',
        ]);

        $item = new Item();
        $item->user_id = Auth::id();
        $item->name = $request->name;
        $item->brand_name = $request->brand_name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->condition_id = $request->condition_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $item->image = $path;
        }
        $item->save();

        $item->categories()->attach($request->category_ids);

        return redirect()->route('items.index');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $items = Item::where('name', 'like', '%' . $query . '%')->get();

        return view('index', compact('items'));
    }
}
