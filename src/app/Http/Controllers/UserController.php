<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

    if (!$user->profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();
    }else {
        $profile = $user->profile;
    }

    $user->profile->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
    ]);

    if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->profile->update(['image' => $imagePath]);
        }

    return redirect('/')->with('success', 'プロフィールが更新されました！');

    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Profile::create([
            'user_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->route('mypage');
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();

        if ($request->tab === 'bought') {
            $items = $user->bought_items ?: collect(); 
        } else {
            $items = $user->items ?: collect(); 
        }

        return view('mypage', compact('user', 'items'));
    }

}
