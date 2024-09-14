<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Track extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'artist_name',
        'title',
        'track_type_id',
        'user_id',
        'beat_id',
        'genre_id',
        'language',
        'feats',
        'isrc',
        'composer',
        'text',
        'flg_adult',
        'text_author',
        'track_copyright_variant_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function track_type(): BelongsTo
    {
        return $this->belongsTo(TrackType::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function track_copyright_variant_id(): BelongsTo
    {
        return $this->belongsTo(TrackCopyrightVariant::class);
    }



}
