<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account_types extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $table = 'account_types';
    public function user(){
        return $this->hasMany(User::class);
    }
}
