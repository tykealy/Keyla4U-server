<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function favorite(){
        return $this->belongsTo(Favorite::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
