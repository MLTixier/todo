<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    protected $table = 'Listes';

    public function produits(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Produit::class)->withPivot('est_coche', 'quantite');
    }
}
