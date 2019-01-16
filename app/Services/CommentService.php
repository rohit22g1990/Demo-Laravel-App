<?php
namespace SocialMediaBlog\Services;


use Illuminate\Http\Request;
use SocialMediaBlog\Repositories\CommentsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CommentService
{

	private $CommentsRepository;

	
	public function __construct(CommentsRepository $CommentsRepository)
	{
		$this->CommentsRepository = $CommentsRepository;
	}

	public function create($data)
	{
		
		$commentData 				= $data->only($this->CommentsRepository->model->getModel()->fillable);
		$commentData['created_by']  = Auth::user()->id ?? NULL;

		return $this->CommentsRepository->model->create($commentData);
	}

}