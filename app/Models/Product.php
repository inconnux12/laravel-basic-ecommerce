<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function unit()
    {
        return $this->hasOne(Unit::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function image()
    {
        return $this->hasOne(Image::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'buys','user_id','product_id')
        ->withPivot('nbr_purchases')
        ->withPivot('total')
        ->withPivot('status');
        
    }

}
