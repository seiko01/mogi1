<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id', 'name', 'brand_name', 'description', 'price', 'category_id', 'condition_id', 'image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
