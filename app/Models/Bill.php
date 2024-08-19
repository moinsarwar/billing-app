<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = ['bill_id', 'date', 'total_amount'];

    public function items()
    {
        return $this->hasMany(BillItem::class);
    }
}
