<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GSTBillings extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_type_id',
        'invoice_date',
        'invoice_no',
        'item_description',
        'total_amount',
        'cgst_rate',
        'sgst_rate',
        'igst_rate',
        'cgst_amount',
        'sgst_amount',
        'igst_amount',
        'tax_amount',
        'net_amount',
        'declaration',
        'is_deleted',
    ];
}
