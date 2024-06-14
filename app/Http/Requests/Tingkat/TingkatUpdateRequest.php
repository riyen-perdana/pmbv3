<?php

namespace App\Http\Requests\Tingkat;

use Illuminate\Foundation\Http\FormRequest;

class TingkatUpdateRequest extends FormRequest
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
            'txtTingkatPrestasi' => 'required|max:255',
            'txtNilaiTingkatPrestasi' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'txtTingkatPrestasi.required' => 'Tingkat Prestasi Harus Diisi',
            'txtTingkatPrestasi.max' => 'Tingkat Prestasi Maksimal 255 Karakter',
            'txtNilaiTingkatPrestasi.required' => 'Nilai Tingkat Prestasi Harus Diisi',
            'txtNilaiTingkatPrestasi.numeric' => 'Nilai Tingkat Prestasi Harus Berupa Angka'
        ];
    }
}
