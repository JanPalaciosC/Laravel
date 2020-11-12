<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    public function category()
    {
        #return $this->belongsTo('App\Models\Category', 'category_id');
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'name',
        'description',
        'clasification',
        'minutes',
        'year',
        'cover',
        'trailer',
        'category_id',
    ];
}

