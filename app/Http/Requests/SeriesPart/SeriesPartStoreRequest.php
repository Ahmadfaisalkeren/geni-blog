<?php

namespace App\Http\Requests\SeriesPart;

use Illuminate\Foundation\Http\FormRequest;

class SeriesPartStoreRequest extends FormRequest
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
            'series_id' => 'required',
            'part_number' => 'required|numeric',
            'title' => 'required|string|max:255',
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
            'series_id.required' => 'Seri harus dipilih.',
            'part_number.required' => 'Nomor bagian harus diisi.',
            'part_number.numeric' => 'Nomor bagian harus berupa angka.',
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
        ];
    }
}
