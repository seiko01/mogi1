<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 商品購入ページを表示
    public function show($itemId)
    {
        $item = Item::findOrFail($itemId);
        $user = Auth::user();
        $profile = $user->profile;

        return view('purchase', compact('item', 'profile'));
    }

public function store(Request $request, $itemId)
{
    $item = Item::findOrFail($itemId);

    $order = new Order();
    $order->user_id = Auth::id();
    $order->item_id = $item->id; // 商品IDを追加
    $order->quantity = 1; // 数量を追加
    $order->total_amount = $item->price;
    $order->payment_method = $request->input('payment_method', 'credit_card'); // 仮の支払い方法
    $order->placed_at = now();
    $order->save();

    return redirect()->route('mypage')->with('success', '購入が完了しました！');
}

public function editAddress($item_id)
{
    $user = Auth::user();
    $profile = $user->profile; // 住所情報を取得

    $item = Item::findOrFail($item_id);

    return view('address_edit', compact('profile', 'item'));
}
public function updateAddress(Request $request, $item_id)
{
    $request->validate([
        'postcode' => 'required|string',
        'address' => 'required|string',
        'building' => 'nullable|string',
    ]);

    $user = Auth::user();
    $user->profile->update([
        'postcode' => $request->postcode,
        'address' => $request->address,
        'building' => $request->building,
    ]);

    return redirect()->route('purchase.show', ['item' => $item_id])->with('success', '住所を更新しました！');
}
}
