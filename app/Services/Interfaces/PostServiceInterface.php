<?php
namespace App\Services\Interfaces;

use App\Models\Post;

interface PostServiceInterface {
    public function getAll(array $filters);
    public function get(string $slug);
    public function store(array $data);
    public function update(array $data, string $slug);
    public function destroy(string $slug);
}