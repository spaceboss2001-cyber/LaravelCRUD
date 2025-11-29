<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category'];

    public function dailymenus()
    {
        return $this->belongsToMany(Carpart::class, 'dish_menus')
            ->withPivot('category')
            ->withTimestamps();
    }
}
