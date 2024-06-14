<?php

namespace App\Http\Requests\Prestasi;

use Illuminate\Foundation\Http\FormRequest;

class PrestasiStoreRequest extends FormRequest
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
            'txtBidangPrestasi' => 'required|max:255',
            'txtNilaiBidangPrestasi' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'txtBidangPrestasi.required' => 'Bidang Prestasi Harus Diisi',
            'txtBidangPrestasi.max' => 'Bidang Prestasi Maksimal 255 Karakter',
            'txtNilaiBidangPrestasi.required' => 'Nilai Bidang Prestasi Harus Diisi',
            'txtNilaiBidangPrestasi.numeric' => 'Nilai Bidang Prestasi Harus Angka',
        ];
    }
}
