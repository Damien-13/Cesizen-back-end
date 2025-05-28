<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'nom_fichier',
        'restreint',
        'url',
        'valide',
        'user_id',
        'article_categorie_id',
        'article_type_id',
        'relation_type_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function articleCategorie(): BelongsTo
    {
        return $this->belongsTo(articleCategorie::class);
    }

    public function articleType(): BelongsTo
    {
        return $this->belongsTo(articleType::class);
    }

    public function relationType(): BelongsTo
    {
        return $this->belongsTo(RelationType::class);
    }
}
