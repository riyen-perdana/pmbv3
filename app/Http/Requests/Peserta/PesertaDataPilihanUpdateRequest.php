<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;

class PesertaDataPilihanUpdateRequest extends FormRequest
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
            'cboPilihan1' => 'required',
            'cboPilihan2' => 'required',
            'cboPilihan3' => 'required',
            'cboPilihan4' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'cboPilihan1.required' => 'Pilihan 1 Harus Diisi',
            'cboPilihan2.required' => 'Pilihan 2 Harus Diisi',
            'cboPilihan3.required' => 'Pilihan 3 Harus Diisi',
            'cboPilihan4.required' => 'Pilihan 4 Harus Diisi',
        ];
    }
}
