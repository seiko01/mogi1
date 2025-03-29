<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemLikeController extends Controller
{
public function store($id)
    {
        if (Auth::guest()) {
            return response()->json(['message' => 'ログインしてください'], 401);
        }

        $existingLike = Like::where('user_id', Auth::id())->where('item_id', $id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $isLiked = false;
        } else {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->item_id = $id;
            $like->save();
            $isLiked = true;
        }
    return redirect()->route('item.show', ['item' => $id])->with('isLiked', $isLiked);
    }

    public function destroy($id)
    {
        $like = Like::where('user_id', Auth::id())->where('item_id', $id)->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $isLiked = true;
        }

        return redirect()->route('item.show', ['item' => $id])->with('isLiked', $isLiked);
    }
    public function myList()
    {
        $likes = Like::where('user_id', Auth::id())->get();
        $items = Item::whereIn('id', $likes->pluck('item_id'))->get();
        return view('mylist', compact('items'));
    }
    public function show($id)
        {
            $item = Item::findOrFail($id);
            $isLiked = session('isLiked', Like::where('user_id', Auth::id())->where('item_id', $item->id)->exists());

            return view('show', compact('item', 'isLiked'));
        }
    }
