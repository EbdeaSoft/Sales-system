<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\branchs;
class resource_purchases extends Model
{
    use HasFactory;
    protected $fillable = [
        'orderId'
       ,'suplier_id',
       'In_debt',
       'Pay_Method_Name',
       'notes',
       'recoveredـpieces',  
        'created_at',
        'branchs_id',
        'updated_at',
   ];
   public function supllier()
   {
       return $this->belongsTo(supllier::class,'suplier_id');
   }
   public function branch()
   {
       return $this->belongsTo(branchs::class,'branchs_id');
   }
}
