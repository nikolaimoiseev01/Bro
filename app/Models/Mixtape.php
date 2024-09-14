<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Mixtape extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'mixtape_status_id',
        'streamings'
    ];

    protected $casts = [
        'streamings' => 'array'
    ];

    public function mixtape_status(): BelongsTo
    {
        return $this->belongsTo(MixtapeStatus::class);
    }

    public function MixtapeParticipation(): HasMany
    {
        return $this->hasMany(MixtapeParticipation::class);
    }

}
