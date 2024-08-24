<?php

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use Commentable;
    use HasFactory;

    protected $fillable = [
        'board_column_id',
        'position',
        'title',
        'description',
        'ready_at',
    ];

    protected function casts(): array
    {
        return [
            'ready_at' => 'timestamp',
        ];
    }

    public function members(): HasMany
    {
        return $this->hasMany(CardMember::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(CardAttachment::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(BoardLabel::class, 'card_labels')->withTimestamps();
    }

    public function column(): BelongsTo
    {
        return $this->belongsTo(BoardColumn::class, 'board_column_id');
    }

    public function todos(): HasMany
    {
        return $this->hasMany(CardTodo::class)->orderBy('position');
    }

    // Methods

    public function getLabelById(int $id)
    {
        return $this->labels()->where('id', $id)->first();
    }
}
