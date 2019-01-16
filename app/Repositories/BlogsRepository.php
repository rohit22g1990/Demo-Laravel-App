<?php 

namespace SocialMediaBlog\Repositories;

use SocialMediaBlog\Models\Blog;

class BlogsRepository implements RepositoryInterface 
{

	/**
     * To initialize class ovjects/variables.
     *
     * @param Blog $model
     */

	public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of model
     */

    public function all()
    {
        return $this->model->all();
    }

    /**
     * create a new record in the database
     *
     * @param array $data
     */

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update record in the database
     *
     * @param array $data, $id
     */

    public function update(array $data, $id)
    { 
        $record = $this->model->find($id);
        return $record->update($data);
    }

    /**
     * show the record with the given id
     *
     * @param $id
     */

    public function show($id)
    {
        return $this->model-findOrFail($id);
    }

}

