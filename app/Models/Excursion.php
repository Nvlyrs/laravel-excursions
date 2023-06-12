<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Excursion extends Model
{
    use HasFactory;

    protected $table = 'excursions';

    /**
     * Get the user that owns the excursion.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the type that owns the excursion.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ExcursionType::class, 'type_id', 'id');
    }

    /**
     * The excursion date frames that belong to the excursion.
     */
    public function dateFrames(): HasMany
    {
        return $this->hasMany(ExcursionDateFrame::class);
    }

    /**
     * The comments that belong to the excursion.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->with(['user']);
    }

    public function favorites(): HasMany {
        return $this->hasMany(Favorite::class);
    }
}
