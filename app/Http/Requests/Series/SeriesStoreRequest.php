<?php

namespace App\Http\Requests\Series;

use Illuminate\Foundation\Http\FormRequest;

class SeriesStoreRequest extends FormRequest
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
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,svg,jpeg|max:4000',
            'status' => 'required|in:hide,publish',
            'series_date' => 'required|date',
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
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'description.required' => 'Deskripsi harus diisi.',
            'author.required' => 'Penulis harus diisi.',
            'author.max' => 'Nama penulis tidak boleh lebih dari :max karakter.',
            'image.required' => 'Gambar sampul harus diunggah.',
            'image.mimes' => 'Format gambar tidak valid. Format yang diterima: :values.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'series_date.required' => 'Tanggal seri harus diisi.',
            'series_date.date' => 'Format tanggal tidak valid.',
        ];
    }
}
