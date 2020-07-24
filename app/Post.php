<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable =
        [
            'title',
            'author',
            'content',
            'status',
            'published_at',
            'created_by'
        ];

    public function getUser(){
        return $this->hasOne(User::class);
    }
}
