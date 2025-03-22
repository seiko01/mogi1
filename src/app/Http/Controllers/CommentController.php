<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
public function store(Request $request, $itemId)
{
    $request->validate([
        'comment' => 'required|string|max:500',
    ]);

    Comment::create([
        'item_id' => $itemId,
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'コメントを送信しました！');
}
}