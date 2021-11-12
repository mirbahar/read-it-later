<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'name'
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
