<?php

namespace App\Models;

use App\Events\ContentProcessed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function pocket(): BelongsTo
    {
        return $this->belongsTo(Pocket::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function (Content $content) {

            ContentProcessed::dispatch($content);
        });

        static::deleting(function (Content $content) {

            $content->tags()->delete();
        });
    }

}
