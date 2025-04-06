<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Like;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id', 'name', 'brand_name', 'description', 'price', 'condition_id', 'image', 'status'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories')
        ->withTimestamps();
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
