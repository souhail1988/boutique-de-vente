<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','sku','price','quantity','category_id'];
    /**
     * Get the post that owns the comment.
     */
    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
