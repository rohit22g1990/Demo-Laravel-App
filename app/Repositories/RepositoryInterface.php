<?php 
namespace SocialMediaBlog\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function show($id);
}