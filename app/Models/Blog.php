<?php

namespace SocialMediaBlog\Models;



use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'description','created_by','updated_by',
    ];
}
