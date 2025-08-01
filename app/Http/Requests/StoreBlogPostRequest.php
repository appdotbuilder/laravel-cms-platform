<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest
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
            'slug' => 'nullable|string|unique:blog_posts,slug|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|string|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Blog post title is required.',
            'content.required' => 'Blog post content is required.',
            'author_id.required' => 'Author is required.',
            'author_id.exists' => 'Selected author does not exist.',
            'category_id.exists' => 'Selected category does not exist.',
            'slug.unique' => 'This slug is already taken.',
            'featured_image.url' => 'Featured image must be a valid URL.',
            'tags.*.exists' => 'One or more selected tags do not exist.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if (auth()->check() && !$this->has('author_id')) {
            $this->merge([
                'author_id' => auth()->id(),
            ]);
        }
    }
}