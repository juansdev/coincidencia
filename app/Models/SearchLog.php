<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, $uuid)
 */
class SearchLog extends Model
{
    use HasFactory;

    public mixed $execution_status;
    protected $fillable = [
        'uuid',
        'searched_name',
        'percent_match',
        'execution_status'
    ];

    public function searchLogPersonPublics(): HasMany
    {
        return $this->hasMany(SearchLogPersonPublic::class);
    }
}
