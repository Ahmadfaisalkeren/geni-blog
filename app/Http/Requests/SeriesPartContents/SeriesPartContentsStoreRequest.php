<?php

namespace App\Http\Requests\SeriesPartContents;

use Illuminate\Foundation\Http\FormRequest;

class SeriesPartContentsStoreRequest extends FormRequest
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
            'series_part_id' => 'required',
            'type' => 'required|in:text,code,image',
            'content' => $this->contentValidationRule(),
        ];
    }

    public function contentValidationRule()
    {
        if ($this->type === "image") {
            return 'required|mimes:jpg,png,svg,jpeg|max:4000';
        }

        return 'required|string';
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'series_part_id.required' => 'Bagian seri harus dipilih.',
            'type.required' => 'Jenis konten harus dipilih.',
            'type.in' => 'Jenis konten harus text, code, atau image.',
            'content.required' => 'Konten harus diisi.',
            'content.max' => 'Konten tidak boleh lebih dari :max karakter.',
            'content.mimes' => 'Konten harus berupa file gambar (jpg, png, svg, jpeg).',
        ];
    }
}
