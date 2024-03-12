<?php

namespace App\Http\Requests\Pengguna;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaUpdateRequest extends FormRequest
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
            'nipNik' => 'required|numeric|unique:users,nip,'.$this->pengguna.',id',
            'namaPegawai' => 'required',
            'password' => 'nullable|confirmed',
            'email' => 'required|email|unique:users,email,'.$this->pengguna.',id',
            'otorisasi' => 'required',
            'is_aktif' => 'required'
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
            'nipNik.required' => 'Kolom NIP/NIK Wajib Diisi',
            'nipNIK.number' => 'Kolom NIP/NIK Harus Angka',
            'nipNik.unique' => 'NIP/NIK Sudah Ada, Isikan Yang Lain',
            'namaPegawai.required' => 'Kolom Nama Wajib Diisi',
            'password.confirmed' => 'Kolom Kata Kunci atau Ulangi Kata Kunci Salah',
            'email.required' => 'Kolom Email Wajib Diisi',
            'email.email' => 'Format Kolom Email Tidak Sesuai',
            'email.unique' => 'Email Sudah Ada, Isikan Yang Lain',
            'otorisasi.required' => 'Pilih Salah Satu Otorisasi',
            'is_aktif.required' => 'Pilih Salah Satu Status Aktif'
        ];
    }
}
