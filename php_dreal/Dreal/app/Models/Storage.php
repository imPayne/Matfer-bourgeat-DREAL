<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'level', 'storage'];

    public function zone() {
        return $this->belongsTo(Zone::class);
    }
}