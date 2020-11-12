<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    public function movie()
    {
        return $this->hasMany(Movie::class);
    }

    protected $fillable = [
        'name',
        'description',
    ];
}
