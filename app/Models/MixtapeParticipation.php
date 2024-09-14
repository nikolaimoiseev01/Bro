<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MixtapeParticipation extends Model
{
    use HasFactory;

    protected $fillable = [
        'mixtape_id',
        'track_id',
        'mixtape_part_status_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mixtape(): BelongsTo
    {
        return $this->belongsTo(Mixtape::class);
    }

    public function mixtape_part_status(): BelongsTo
    {
        return $this->belongsTo(MixtapePartStatus::class);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
