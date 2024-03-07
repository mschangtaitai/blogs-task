<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'hide_comments',
        'availible_at'
    ];

    public function comments(): MorphMany {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
