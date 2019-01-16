<?php

namespace SocialMediaBlog;


use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'description','created_by',
    ];

    public function all() {

    	$userBlogs    = $this->orderBy('id', 'DESC')->paginate(10);   
        
        $blogComments = DB::table('comments')
            ->select('comments.comment', 'comments.blog_id', 'users.name', 'users.email', 'comments.created_at')
            ->leftJoin('users', 'users.id', '=', 'comments.created_by')
            ->orderBy('comments.id', 'DESC')
            ->get();  

        return ( [ 'userBlogs' => $userBlogs, 'blogComments' => $blogComments ] );
    }
}
