<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court_category extends Model
{
    use HasFactory;

    protected $gaurded = [''];

    public function court(){
        return $this->hasMany(Court::class);
    }
}
