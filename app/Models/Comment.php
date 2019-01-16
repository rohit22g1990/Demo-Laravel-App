<?php

namespace SocialMediaBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment','blog_id','created_by',
    ];
}
