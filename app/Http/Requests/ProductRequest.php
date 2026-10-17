<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool { return true; } // rute sudah dilindungi middleware auth

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'integer', 'min:0', 'max:100000000'],
            'category' => ['required', 'string', 'max:60'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_featured' => ['boolean'],
            'is_available' => ['boolean'],
        ];
    }

    public function attributes(): array
    {
        return ['name' => 'Nama', 'description' => 'Deskripsi', 'price' => 'Harga', 'category' => 'Kategori', 'image' => 'Foto'];
    }

    public function messages(): array
    {
        return ['required' => ':attribute wajib diisi.', 'image.image' => 'File harus berupa gambar.', 'image.mimes' => 'Foto harus jpg, png, atau webp.',
            'image.max' => 'Ukuran foto maksimal 2 MB.', 'integer' => ':attribute harus angka.'];
    }
}
