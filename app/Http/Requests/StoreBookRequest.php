<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'base' => ['required', 'array'],
            'base.title' => ['required', 'string'],
            'base.description' => ['sometimes', 'string'],
            'base.isbn' => ['required', 'string'],
            'base.author_id' => ['required', 'integer', 'exists:authors,id'],
            'base.publisher_id' => ['required', 'integer', 'exists:publishers,id'],
            'base.release_year' => ['required', 'integer'],
            'base.price' => ['required', 'decimal:0,2'],
            'base.stock' => ['required', 'integer'],
            'base.cover_image_url' => ['sometimes', 'string'],

            'genres' => ['sometimes', 'array'],
            'genres.*' => ['integer', 'exists:genres,id'],

        ];
    }
}
