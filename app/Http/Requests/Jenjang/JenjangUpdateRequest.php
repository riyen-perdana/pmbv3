<?php

namespace App\Http\Requests\Jenjang;

use Illuminate\Foundation\Http\FormRequest;

class JenjangUpdateRequest extends FormRequest
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
            'kdJenjangPendidikan' => 'required|unique:jenjang,kd_jenjang,'.$this->jenjang.',id',
            'isAktif' => 'required',
            'nMJenjangPendidikan' => 'required'
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
            'kdJenjangPendidikan.required' => 'Kolom Kode Jenjang Pendidikan Wajib Diisi',
            'kdJenjangPendidikan.unique' => 'Kode Jenjang Pendidikan Sudah Ada, Isikan Yang Lain',
            'isAktif.required' => 'Pilih Status Aktif Jenjang Pendidikan',
            'nMJenjangPendidikan.required' => 'Kolom Nama Jenjang Pendidikan Wajib Diisi'
        ];
    }
}
