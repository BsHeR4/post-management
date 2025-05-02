<?php
namespace App\Services\Interfaces;

use App\Models\Post;

interface PostServiceInterface {
    public function getAll();
    public function store(array $data);
    public function update(array $data, Post $post);
    public function destroy(Post $post);
}