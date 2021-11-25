<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['posX', 'posY', 'width', 'height', 'alley', 'column'];

    public function storage() {
        return $this->hasMany(Storage::class);
    }
}
