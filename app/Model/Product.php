<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','remain_qty','price','category_id'];
    public function category(){
        return $this->belongsTo(Category::class)->orderBy('name');
    }
}
