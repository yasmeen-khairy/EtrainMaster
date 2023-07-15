<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class review extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'comment',
        'rate',
        'role',
        'course_id',
        'instructor_id',
        'user_id'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(course::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(instructor::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }
}
