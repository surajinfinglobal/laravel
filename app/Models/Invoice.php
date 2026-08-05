<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [

'user_id',

'invoice_number',

'plan',

'billing',

'amount',

'payment_method',

'status',

'paid_at'

];
// app/Models/Invoice.php
public function user()
{
    return $this->belongsTo(User::class);
}
}
