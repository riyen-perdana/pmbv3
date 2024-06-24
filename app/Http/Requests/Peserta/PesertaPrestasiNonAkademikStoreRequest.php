<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;

class PesertaPrestasiNonAkademikStoreRequest extends FormRequest
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
            'txtNmPrestasi' => 'required',
            'cboKelompokPrestasi' => 'required',
            'cboBidangPrestasi' => 'required',
            'cboTingkatPrestasi' => 'required',
            'txtFile' => 'required|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'txtNmPrestasi.required' => 'Kolom Nama Prestasi Wajib Diisi',
            'cboKelompokPrestasi.required' => 'Kolom Kelompok Prestasi Wajib Diisi',
            'cboBidangPrestasi.required' => 'Kolom Bidang Prestasi Wajib Diisi',
            'cboTingkatPrestasi.required' => 'Kolom Tingkat Prestasi Wajib Diisi',
            'txtFile.required' => 'File Prestasi Wajib Diisi',
            'txtFile.mimes' => 'File Prestasi Harus Berupa PDF',
            'txtFile.max' => 'File Prestasi Maksimal 2 MB'
        ];
    }
}
