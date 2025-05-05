<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PreparePostInput
{

    /**
     * @param array $input this method for preaparing the slug format
     * if the user didn't enter the slug with processiong unique values
     * depend on title value
     * 
     * @return array
     */
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

    /**
     * @param array $input this method for preparing is_published field
     * and define the value:
     * - if the publish_date was set then the value will be `false`
     *   which it gonna be modifed to `true` in future by scheduled command
     * 
     * - if the publish date was not set the value will be true
     * 
     * @return array
     */
    public static function preparePublishStatus(array $input): array
    {
        return [
            'is_published' => empty($input['publish_date'])
        ];
    }
}
