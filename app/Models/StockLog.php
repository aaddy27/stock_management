<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $fillable = [
        'stock_id',
        'type',
        'amount',
        'remarks',
    ];
    public function stock()
{
    return $this->belongsTo(Stock::class);
}

}
