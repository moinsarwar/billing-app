<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    use HasFactory;
    protected $table = 'bill_items';
    protected $fillable = ['bill_id', 'product_name', 'product_price', 'quantity', 'total_amount', 'product_id' ,'product_size'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
