<?php

namespace App\Services;

use App\Models\Post;
use App\Services\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{

    public function getAll() {}

    public function store(array $data) {}

    public function update(array $data, Post $post) {}

    public function destroy(Post $post) {}
}
