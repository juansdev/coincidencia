<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchLogPersonPublic extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_log_id',
        'person_public_id'
    ];

    public function personPublic(): BelongsTo
    {
        return $this->belongsTo(PersonPublic::class)->with(['department', 'municipality', 'location', 'typePerson', 'typePosition']);
    }

    public function searchLog(): BelongsTo
    {
        return $this->belongsTo(SearchLog::class);
    }
}
