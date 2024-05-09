<?php

namespace App\Http\Requests\SeriesPartContents;

use Illuminate\Foundation\Http\FormRequest;

class SeriesPartContentsUpdateRequest extends FormRequest
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
            'series_part_id' => 'nullable',
            'type' => 'nullable|in:text,code,image',
            'content' => 'nullable',
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
            'type.in' => 'Jenis konten harus text, code, atau image.',
            'content.max' => 'Konten tidak boleh lebih dari :max karakter.',
            'content.mimes' => 'Konten harus berupa file gambar (jpg, png, svg, jpeg).',
        ];
    }
}
