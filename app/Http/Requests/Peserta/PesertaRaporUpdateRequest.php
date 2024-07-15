<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;

class PesertaRaporUpdateRequest extends FormRequest
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
            'txtNilaiMTK' => 'required|numeric|between:0.00,100.00',
            'txtNilaiPAI' => 'required|numeric|between:0.00,100.00',
        ];
    }

    public function messages(): array
    {
        return [
            'txtNilaiMTK.required' => 'Kolom Nilai Matematika Wajib Diisi',
            'txtNilaiMTK.between' => 'Nilai Matematika Harus 0.00 - 100.00',
            'txtNilaiPAI.required' => 'Kolom Nilai Pendidikan Agama Islam Wajib Diisi',
            'txtNilaiPAI.between' => 'Nilai Pendidikan Agama Islam Harus 0.00 - 100.00',
        ];
    }
}
