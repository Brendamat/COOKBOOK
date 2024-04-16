<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipee_id',
        'path',
    ];

    public function recipee()
    {
        return $this->hasOne(Recipee::class);
    }
}
