<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = ['posX', 'posY', 'width', 'height'];

    public function zones() {
        return $this->hasMany(Zone::class);
    }
}