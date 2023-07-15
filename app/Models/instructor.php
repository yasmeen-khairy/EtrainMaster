<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class instructor extends Model
{
    use HasFactory;

    protected $fillable = [
     
        'spec',
        'phone',
        'user_id'

    ];

    public function courses(): HasMany
    {
        return $this->hasMany(course::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(review::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
