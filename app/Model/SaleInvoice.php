<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    protected $with=['products','user'];
    protected $fillable=['invoice_no','date_time','total_kyats','user_id','customer_id'];
    public function products(){
        return $this->belongsToMany(Product::class,'product_sale','sale_id','product_id')->withPivot('qty');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
