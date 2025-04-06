<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;  // Item クラスのインポート

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_categories')
                    ->withTimestamps();
    }
}
