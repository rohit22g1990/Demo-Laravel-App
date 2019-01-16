<?php

namespace SocialMediaBlog\Http\Controllers;

use SocialMediaBlog\Comment;
use SocialMediaBlog\Models\Blog;
use SocialMediaBlog\Services\CommentService;
use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
   

   public function __construct( CommentService $CommentService) 
    {

        $this->CommentService = $CommentService;
    }

    /**
     * create new comment
     *
     * @return $id
     */
    
    public function create( $id ) {

        $blog = Blog::find($id);
        
        return view('add_comment', [ 'blog' => $blog ] );
    }

    /**
     * Store a newly created Comments in Comment table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {   
        
        Validator::make($request->all(), [
            'comment' => 'required|max:550',
        ])->validate();

        $this->CommentService->create($request);
        
        $blogId = $request->input('blog_id');

        return Redirect::to('/show_blog/'.$blogId)->with('message', 'Comment Added Succesfully');
    }
}
