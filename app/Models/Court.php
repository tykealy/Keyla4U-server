<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pitch(){
        return $this->hasMany(Pitch::class);
    }

    public function court_category(){
        return $this->belongsTo(Court_category::class);
    }
}
