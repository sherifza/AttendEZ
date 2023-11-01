<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * The users that belong to this category.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
