<?php

namespace App\Http\Requests\Pradaftar;

use Illuminate\Foundation\Http\FormRequest;

class PradaftarStoreRequest extends FormRequest
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
            'nisn' => 'required|numeric|digits:10',
            'tglLhr' => 'required',
            'telepon' => 'required|regex:/^08[0-9]{9,12}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'nisn.required' => 'Kolom Nomor Induk Siswa Nasional Harus Diisi',
            'nisn.digits' => 'Kolom Nomor Induk Siswa Nasional Harus 10 Digit',
            'nisn.numeric' => 'Kolom Nomor Induk Siswa Nasional Harus Angka',
            'tglLhr.required' => 'Kolom Tanggal Lahir Harus Diisi',
            'telepon.required' => 'Kolom Nomor Telepon/HP Harus Diisi',
            'telepon.regex' => 'Kolom Nomor Telepon/HP Tidak Valid',
        ];
    }
}
