<?php
namespace SocialMediaBlog\Services;


use Illuminate\Http\Request;
use SocialMediaBlog\Repositories\BlogsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogService
{

	private $BlogsRepository;

	public function __construct(BlogsRepository $BlogsRepository)
	{
		$this->BlogsRepository = $BlogsRepository;
	}

	public function getAllBlogs()
	{
		$userBlogs = $this->BlogsRepository->model
			->select('blogs.description', 'blogs.title', 'users.name', 'blogs.created_at', 'blogs.created_by', 'blogs.id')
	        ->leftJoin('users', 'users.id', '=', 'blogs.created_by')
			->orderBy('id', 'DESC')->paginate(10);

        return ( [ 'userBlogs' => $userBlogs ] );    
	}

	public function create($data)
	{
		
		$blogData 				 = $data->only($this->BlogsRepository->model->getModel()->fillable);
		$blogData['created_by']  = Auth::user()->id;
		$blogData['updated_by']  = Auth::user()->id;

		return $this->BlogsRepository->model->create($blogData);
	}

	public function find($id)
	{
		return $this->BlogsRepository->model->find($id);
	}

	public function getBlog($id)
	{
		$userBlog    = $this->BlogsRepository->model->find($id);

		$blogComments = DB::table('comments')
            ->select('comments.comment', 'comments.blog_id', 'users.name', 'users.email', 'comments.created_at')
            ->leftJoin('users', 'users.id', '=', 'comments.created_by')
            ->where('comments.blog_id', '=', $id)
            ->orderBy('comments.id', 'DESC')
            ->get(); 

        return ( ['userBlog' => $userBlog, 'blogComments' => $blogComments] );        
	}


	public function update($data, $id)
	{

		$blogData 				= $data->only( $this->BlogsRepository->model->getModel()->fillable );
		$blogData['updated_by'] = Auth::user()->id;

		return $this->BlogsRepository->update($blogData, $id);
	}

}