<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 商品購入ページの表示
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('purchase', compact('item'));
    }

    // 商品を購入する処理（POST）
    public function processPurchase(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        // 購入処理（例: データベースに購入情報を保存）
        $purchase = new Purchase();
        $purchase->user_id = Auth::id();
        $purchase->item_id = $item->id;
        $purchase->address = $request->address;
        $purchase->save();

        return redirect()->route('purchase', ['item_id' => $item_id])->with('success', '商品を購入しました！');
    }

    // 送付先住所変更ページの表示
    public function updateAddress($item_id)
    {
        $item = Item::findOrFail($item_id);
        $purchase = Purchase::where('user_id', Auth::id())->where('item_id', $item_id)->firstOrFail();
        return view('update_address', compact('item', 'purchase'));
    }

    // 送付先住所の変更処理（PATCH）
    public function processUpdateAddress(Request $request, $item_id)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $purchase = Purchase::where('user_id', Auth::id())->where('item_id', $item_id)->firstOrFail();
        $purchase->address = $request->address;
        $purchase->save();

        return redirect()->route('purchase.address', ['item_id' => $item_id])->with('success', '送付先住所を更新しました！');
    }
}
