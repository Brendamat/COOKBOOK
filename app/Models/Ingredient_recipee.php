<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient_recipee extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'recipee_id',
        'measure_id',
        'quantity',
    ];

    public function ingredient()
    {
        return $this->hasOne(Ingredient::class);
    }

    public function recipee()
    {
        return $this->hasOne(Recipee::class);
    }

    public function measure()
    {
        return $this->hasOne(Measure::class);
    }
}
