<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardTodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'name',
        'position',
        'is_checked',
    ];

    protected function casts(): array
    {
        return [
            'is_checked' => 'boolean',
        ];
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
