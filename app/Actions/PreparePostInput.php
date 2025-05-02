<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PreparePostInput
{
    public static function prepareSlug(array $input): array
    {
        $data = $input;

        if (empty($data['slug']) && !empty($data['title'])) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;

            while (DB::table('posts')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . Str::lower(Str::random(6));
            }

            $data['slug'] = $slug;
        }

        return $data;
    }

    public static function preparePublishStatus(array $input): array
    {
        return [
            'is_published' => !empty($input['publish_date'])
        ];
    }
}
