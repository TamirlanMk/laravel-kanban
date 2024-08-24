<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'is_public',
    ];

    public function labels(): HasMany
    {
        return $this->hasMany(BoardLabel::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function columns(): HasMany
    {
        return $this->hasMany(BoardColumn::class)->orderBy('position');
    }

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }
}
