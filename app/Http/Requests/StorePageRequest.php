<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
            'slug' => 'nullable|string|unique:pages,slug|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'images' => 'nullable|array',
            'images.*' => 'string|url',
            'videos' => 'nullable|array',
            'videos.*' => 'string|url',
            'is_published' => 'boolean',
            'has_contact_form' => 'boolean',
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
            'title.required' => 'Page title is required.',
            'content.required' => 'Page content is required.',
            'slug.unique' => 'This slug is already taken.',
            'images.*.url' => 'Each image must be a valid URL.',
            'videos.*.url' => 'Each video must be a valid URL.',
        ];
    }
}