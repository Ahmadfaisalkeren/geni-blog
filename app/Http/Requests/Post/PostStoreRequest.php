<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => 'required|string|min:8|max:255',
            'post_date' => 'required|date',
            'author' => 'required|string|max:255',
            'image' => 'required|mimes:jpg,png,svg,jpeg|max:4000',
            'status' => 'required|in:publish,hide'
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
            'title.required' => 'Kolom judul harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.min' => 'Judul harus memiliki minimal :min karakter.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'post_date.required' => 'Kolom tanggal posting harus diisi.',
            'post_date.date' => 'Tanggal posting harus berupa format tanggal yang valid.',
            'author.required' => 'Kolom penulis harus diisi.',
            'author.string' => 'Penulis harus berupa teks.',
            'author.max' => 'Panjang penulis tidak boleh lebih dari :max karakter.',
            'image.required' => 'Kolom gambar harus diisi.',
            'image.mimes' => 'Gambar harus berupa file dengan format: :values.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
            'status.required' => 'Kolom status harus diisi.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }
}
