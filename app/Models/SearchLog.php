<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SearchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'searched_name',
        'percentage_sought',
        'execution_status'
    ];
    
    public function searchLogPersonPublics(): HasMany
    {
        return $this->hasMany(SearchLogPersonPublic::class);
    }
}
