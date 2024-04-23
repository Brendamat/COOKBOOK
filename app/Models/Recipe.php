<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employee_id',
        'creation_date',
        'portions',
        'category_id',
        'published',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredient_recipes()
    {
        return $this->hasMany(Ingredient_recipe::class);
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
