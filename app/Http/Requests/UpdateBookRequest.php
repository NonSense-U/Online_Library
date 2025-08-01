<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'base' => ['sometimes', 'array'],
            'base.title' => ['sometimes', 'string'],
            'base.description' => ['sometimes', 'string'],
            'base.isbn' => ['sometimes', 'string'],
            'base.author_id' => ['sometimes', 'integer', 'exists:authors,id'],
            'base.publisher_id' => ['sometimes', 'integer', 'exists:publishers,id'],
            'base.release_year' => ['sometimes', 'integer'],
            'base.price' => ['sometimes', 'decimal:0,2'],
            'base.stock' => ['sometimes', 'integer'],
            'base.cover_image_url' => ['sometimes', 'string'],
            'genres' => ['sometimes', 'array'],
            'genres.*' => ['integer', 'exists:genres,id'],
        ];
    }
}
