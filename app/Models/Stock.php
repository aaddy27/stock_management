<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'item_name',
        'category',
        'quantity',
    ];
public function logs()
{
    return $this->hasMany(StockLog::class);
}

}

