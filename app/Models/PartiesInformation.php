<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartiesInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'parties_type_id',
        'fullname',
        'contact',
        'address',
        'account_holder_name',
        'account_no',
        'bank_name',
        'ifsc_code',
        'branch_address',
    ];

    // inverse relation to access its assocaite model
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
}
