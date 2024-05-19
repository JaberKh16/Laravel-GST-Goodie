<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Party extends Model
{
    use HasFactory;

    protected $table = "parties";

    protected $fillable = [
        'parties_type',
        'email',
        'password',
        'status',
    ];

    // one to one relation to access its assocaite model
    public function party_info(): HasOne
    {
        return $this->hasOne(PartiesInformation::class, 'parties_type_id', 'id');
    }
}
