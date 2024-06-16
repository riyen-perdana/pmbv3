<?php

namespace App\Http\Requests\Jenis;

use Illuminate\Foundation\Http\FormRequest;

class JenisStoreRequest extends FormRequest
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
            'txtJenisPrestasi' => 'required|max:255',
            'txtNilaiJenisPrestasi' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'txtJenisPrestasi.required' => 'Kolom Jenis Prestasi Harus Diisi',
            'txtJenisPrestasi.max' => 'Kolom Jenis Prestasi Maksimal 255 Karakter',
            'txtNilaiJenisPrestasi.required' => 'Kolom Nilai Jenis Prestasi Harus Diisi',
            'txtNilaiJenisPrestasi.numeric' => 'Kolom Nilai Jenis Prestasi Harus Angka',
        ];
    }
}
