<?php

namespace App\Http\Requests\Series;

use Illuminate\Foundation\Http\FormRequest;

class SeriesUpdateRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:png,jpg,svg,jpeg|max:4000',
            'status' => 'nullable|in:hide,publish',
            'series_date' => 'nullable|date',
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
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'author.max' => 'Nama penulis tidak boleh lebih dari :max karakter.',
            'image.mimes' => 'Format gambar tidak valid. Format yang diterima: :values.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'series_date.date' => 'Format tanggal tidak valid.',
        ];
    }
}
