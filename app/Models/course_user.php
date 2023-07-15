<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class course_user extends Model
{
    use HasFactory;
    protected $fillable = ['course_id' , 'user_id' , 'status'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class , 'course_users' , 'course_id' , 'user_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(course::class , 'course_users' , 'user_id' , 'course_id');
    }
}
