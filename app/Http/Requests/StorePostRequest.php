<?php

namespace App\Http\Requests;

use App\Actions\PreparePostInput;
use App\Rules\PublishDateRule;
use App\Rules\SlugFormatRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug', new SlugFormatRule()],
            'body' => 'required|string',
            'publish_date' => ['nullable', 'date', new PublishDateRule()],
            'is_published' => 'boolean',
            'meta_description' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'the post title should not be empty, please add the post title!',
            'title.max' => 'the title is too long!',

            'slug.max' => 'the slug is too long!',
            'slug.unique' => 'the slug already used please try another one',

            'meta_description.required' => 'the meta description should not be empty, please add the meta description!',
            'meta_description.max' => 'the meta description is too long!',

            'publish_date.date' => 'the publish date should be only date format',

            'body.required' => 'the body post should not be empty, please add the body post!',

            'tags.array' => 'tags should contain a list of values',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'post title',
            'body' => 'post body',
            'publish_date' => 'publish date',
            'meta_description' => 'meta description',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(array_merge(
            PreparePostInput::prepareSlug(
                $this->only([
                    'title',
                    'slug'
                ])
            ),
            PreparePostInput::preparePublishStatus(
                $this->only([
                    'publish_date',
                    'is_published'
                ])
            )
        ));
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Failed Validate Data',
            'errors' => $validator->errors(),
        ], 422));
    }
}
