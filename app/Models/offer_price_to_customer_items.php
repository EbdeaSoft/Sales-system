<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer_price_to_customer_items extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id'
       ,'quantity',
       'order_id',
       'created_at',
       'updated_at',
   
   ];
   
     
       public function productData()
       {
           return $this->belongsTo(products::class,'product_id');
       }
}
