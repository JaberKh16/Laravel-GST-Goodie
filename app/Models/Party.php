<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function party_info()
    {
        return $this->HasOne(PartiesInformation::class, 'parties_type_id', 'id');
    }

    public static function get_available_parties_type($parties)
    {
        $parties_type = [];
        $unique_parties_type = [];

        if ($parties) {
            foreach ($parties as $record) {
                // get the party id
                $party_id = $record->id;  
                // use the party id to store the associated parties_type
                if (!in_array($record->parties_type, $unique_parties_type)) {
                    $parties_type[$party_id] = $record->parties_type;
                    $unique_parties_type[] = $record->parties_type;
                }
            }
        } else {
            $parties_type = collect(); 
        }

        return $parties_type;
    }

}
