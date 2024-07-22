<?php

namespace App\Http\Requests\Prodi;

use Illuminate\Foundation\Http\FormRequest;

class ProdiUpdateRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/u';
        return [
            'txtKodeProdi'              => 'required|numeric|unique:prodi,kd_prodi,'.$this->prodi.',id',
            'txtNmProdi'                => 'required',
            'optNmFakultas'             => 'required',
            'optJenjang'                => 'required',
            'optAkreditasi'             => 'required',
            'txtLinkProdi'              => 'sometimes|nullable|regex:' . $regex,
            'txtLinkAkreditasiProdi'    => 'sometimes|nullable|regex:' . $regex,
            'optStatusAktif'            => 'required',
            'cboPil34'                  => 'required',
            'txtQuota'                  => 'required|numeric',
            'optStatusValidasi'         => 'required',
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
            'txtKodeProdi.required'         => 'Kolom Kode Program Studi Harus Diisi',
            'txtKodeProdi.numeric'          => 'Kolom Kode Program Studi Harus Angka',
            'txtKodeProdi.unique'           => 'Kode Program Studi Sudah Ada, Isikan Yang Lain',
            'txtNmProdi.required'           => 'Kolom Nama Program Studi Harus Diisi',
            'optNmFakultas.required'        => 'Pilih Nama Fakultas',
            'optJenjang.required'           => 'Pilih Jenjang Pendidikan',
            'optAkreditasi.required'        => 'Pilih Akreditasi Program Studi',
            'txtLinkProdi.regex'            => 'Link Program Studi Salah',
            'txtLinkAkreditasiProdi.regex'  => 'Link Akreditasi Program Studi Salah',
            'optStatusAktif.required'       => 'Pilih Status Aktif',
            'cboPil34.required'             => 'Pilih Pilihan Program Studi 3-4',
            'txtQuota.required'             => 'Kolom Quota Harus Diisi',
            'txtQuota.numeric'              => 'Kolom Quota Harus Angka',
            'optStatusValidasi.required'    => 'Pilih Status Validasi',
        ];
    }
}
