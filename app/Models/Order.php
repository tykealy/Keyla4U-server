<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pitch;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pitch(){
        return $this->belongsTo(Pitch::class);
    }
}
