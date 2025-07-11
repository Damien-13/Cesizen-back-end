<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commentaire extends Model
{
    protected $fillable = [
        'lib_commentaire',
        'visible',
        'user_id',
        'article_id',
        'parent_id'
    ];

    public function reponses(): HasMany
    {
        return $this->hasMany(Commentaire::class, 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(article::class);
    }
}
