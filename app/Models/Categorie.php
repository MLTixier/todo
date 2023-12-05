<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'Categories';
    protected $fillable = ['nom','liste'];
    public $timestamps = false;


    public function produits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Produit::class);
    }

    public function liste(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Liste::class);
    }
}
