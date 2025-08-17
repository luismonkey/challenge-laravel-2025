<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'old_status',
        'new_status'
    ];

    /**
     * Relación con la orden
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
