<?php

namespace App\Http\Requests\Rektor;

use Illuminate\Foundation\Http\FormRequest;

class RektorUpdateRequest extends FormRequest
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
            'idUser' => 'required',
            'rktAwlJbt' => 'required',
            'rktAkhJbt' => 'required|after_or_equal:rktAwlJbt',
            'isRektorAktif' => 'required',
            'isRektorPlt' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'idUser.required' => 'Kolom NIP Rektor Harus Dipilih',
            'rktAwlJbt.required' => 'Kolom Tanggal Awal Jabatan Rektor Harus Diisi',
            'rktAkhJbt.required' => 'Kolom Tanggal Akhir Jabatan Rektor Harus Diisi',
            'rktAkhJbt.after_or_equal' => 'Kolom Tanggal Akhir Jabatan Rektor Harus Diisi',
            'isRektorAktif.required' => 'Pilih Status Aktif Rektor',
            'isRektorPlt.required' => 'Pilih Status PLT Rektor'
        ];
    }
}
