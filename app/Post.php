<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExcerptAttribute()
    {
        return Str::limit($this->body, 10);
    }
}
