<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Club extends Model
{
    use HasFactory;

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $guarded = [''];

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
