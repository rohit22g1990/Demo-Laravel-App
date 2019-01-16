<?php

namespace SocialMediaBlog\Http\Controllers;

use SocialMediaBlog\Models\Blog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use SocialMediaBlog\Services\BlogService;

use Redirect;

class BlogsController extends Controller
{

    private $BlogService;

    /**
     * Initialize class objects/variables.
     *
     * @param BlogService $BlogService
     */

    public function __construct( BlogService $BlogService) 
    {

        $this->BlogService = $BlogService;  
    }

    protected function showBlog($id)
    {     
        return view('blog',$this->BlogService->getBlog($id) );
    }   

    protected function showAllBlogs()
    {
        return view('home', $this->BlogService->getAllBlogs());
    }
    
    protected function create(Request $request) 
    {
        
        Validator::make($request->all(), [
            'title'       => 'required|max:100',
            'description' => 'required|min:10',
        ])->validate();
        
        $this->BlogService->create($request);

        return Redirect::to('/home')->with('message', 'New Blog Added Succesfully');
    }

    protected function edit($id) 
    {
        return view('edit_blog',['blog' => $this->BlogService->find($id)]);
    }

    protected function update( Request $request, $id ) 
    {
        $this->BlogService->update( $request, $id );

        return Redirect::to('/home')->with('message', 'Blog Updated Succesfully');        
    }

}
