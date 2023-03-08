<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class return_sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id'
       ,'invoice_id',
       'value',
       'branch_id',
       'return_Added_Value',
        'return_Unit_Price',
        'return_quantity',
         'created_at',
   ];
   
       public function Invoice()
       {
           return $this->belongsTo(invoices::class,'invoice_id');
       }
       
       public function productData()
       {
           return $this->belongsTo(products::class,'product_id');
       }
       public function branch()
       {
           return $this->belongsTo(App\Models\branchs::class,'branch_id');
       }
}
