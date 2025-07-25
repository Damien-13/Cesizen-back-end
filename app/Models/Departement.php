<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departement extends Model
{
    protected $fillable = [
        'region_id', 
        'lib_departement', 
        'code'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
