<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id', 'phone_id', 'quantity', 'price', 'total'
    ];
    use HasFactory;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }
}
