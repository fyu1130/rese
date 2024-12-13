<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['shop_name', 'category', 'area', 'photo_path', 'detail','manager_id'];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
    public function manager(){
        return $this->belongsTo(User::class . 'manager_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
