<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailymenu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'date'];


    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_menus', 'menu_id', 'dish_id')
            ->withPivot('category')
            ->withTimestamps();
    }
}