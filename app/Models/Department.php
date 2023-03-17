<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(string[] $array)
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }

    public function personPublics(): HasMany
    {
        return $this->hasMany(PersonPublic::class);
    }
}
