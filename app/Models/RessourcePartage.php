<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RessourcePartage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ressource_id',
        'user_id', //Destinataire du partage
    ];

    public function article()
    {
        return $this->belongsTo(article::class);
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
