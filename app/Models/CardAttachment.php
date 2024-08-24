<?php

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardAttachment extends Model
{
    use Commentable;
    use HasFactory;

    protected $fillable = [
        'card_id',
        'caption',
        'path',
        'filename',
        'extension',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function fullPath(): Attribute
    {
        return new Attribute(
            get: fn () => \Storage::disk('public')->path($this->path)
        );
    }
}
