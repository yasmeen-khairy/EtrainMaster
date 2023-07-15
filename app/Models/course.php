<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class course extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = [
        'image',
        'name',
        'desc',
        'price',
        'Schedule',
        'seats',
        'category_id',
        'instructor_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(instructor::class);
    }
    public function reviews() : HasMany
    {
        return $this->hasMany(review::class);
    }

  
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class , 'course_users' , 'course_id' , 'user_id');
    }

}
