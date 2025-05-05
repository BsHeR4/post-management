<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'publish_date',
        'is_published',
        'meta_description',
        'tags',
        'keywords'
    ];

    protected $casts = [
        'tags' => 'array',
        'keywords' => 'array',
    ];

    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    /**
     * to be able to use the slug rather than id
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
