<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'pocket_id',
        'url',
        'title',
        'excerpt',
        'image'
    ];

    public function pocket():BelongsTo
    {
        return $this->belongsTo(Pocket::class);
    }
}
