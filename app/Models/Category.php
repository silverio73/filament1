<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'city',
        'email',
        'phone',
    ];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
}
