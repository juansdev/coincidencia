<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $personPublic)
 */
class PersonPublic extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'municipality_id',
        'location_id',
        'type_person_id',
        'type_position_id',
        'name',
        'active_years'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function typePerson(): BelongsTo
    {
        return $this->belongsTo(TypePerson::class);
    }

    public function typePosition(): BelongsTo
    {
        return $this->belongsTo(TypePosition::class);
    }

    public function searchLogPersonPublics(): HasMany
    {
        return $this->hasMany(SearchLogPersonPublic::class);
    }
}
