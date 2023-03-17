<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(string[] $array)
 */
class TypePosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function personPublics(): HasMany
    {
        return $this->hasMany(PersonPublic::class);
    }
}
