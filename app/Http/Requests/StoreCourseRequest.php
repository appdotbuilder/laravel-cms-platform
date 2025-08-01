<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
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
            'slug' => 'nullable|string|unique:courses,slug|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|string|url',
            'price' => 'required|numeric|min:0',
            'duration_hours' => 'nullable|integer|min:1',
            'level' => ['required', Rule::in(['beginner', 'intermediate', 'advanced'])],
            'instructor_id' => 'required|exists:users,id',
            'is_published' => 'boolean',
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
            'title.required' => 'Course title is required.',
            'description.required' => 'Course description is required.',
            'price.required' => 'Course price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price cannot be negative.',
            'level.required' => 'Course level is required.',
            'level.in' => 'Course level must be beginner, intermediate, or advanced.',
            'instructor_id.required' => 'Instructor is required.',
            'instructor_id.exists' => 'Selected instructor does not exist.',
            'slug.unique' => 'This slug is already taken.',
            'featured_image.url' => 'Featured image must be a valid URL.',
            'duration_hours.integer' => 'Duration must be a whole number of hours.',
            'duration_hours.min' => 'Duration must be at least 1 hour.',
        ];
    }
}