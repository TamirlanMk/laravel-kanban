<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'board_label_id',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function label(): BelongsTo
    {
        return $this->belongsTo(BoardLabel::class, 'board_label_id');
    }
}
