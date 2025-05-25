<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class articleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'lib_article_type',
        'visible'
    ];

    public function ressources(): HasMany
    {
        return $this->hasMany(article::class);
    }
}
