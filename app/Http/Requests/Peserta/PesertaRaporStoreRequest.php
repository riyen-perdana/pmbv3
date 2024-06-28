<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;

class PesertaRaporStoreRequest extends FormRequest
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
            'txtNmtk' => 'required|numeric|between:0.00,100.00',
            'txtNbing' => 'required|numeric|between:0.00,100.00',
            'txtFile' => 'required|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'txtNmtk.required' => 'Kolom Nilai Matematika Wajib Diisi',
            'txtNmtk.between' => 'Nilai Matematika Harus 0.00 - 100.00',
            'txtNbing.required' => 'Kolom Nilai Bahasa Indonesia Wajib Diisi',
            'txtNbing.between' => 'Nilai Bahasa Indonesia Harus 0.00 - 100.00',
            'txtFile.required' => 'File Raport Wajib Diisi',
            'txtFile.mimes' => 'File Raport Harus Berupa PDF',
            'txtFile.max' => 'File Raport Maksimal 2 MB'
        ];
    }
}
