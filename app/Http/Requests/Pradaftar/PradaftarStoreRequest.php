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
            'nisn' => 'required|string|max:10',
            'tglLhr' => 'required',
            'telepon' => 'required|regex:/^08[0-9]{9,12}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'nisn.required' => 'Kolom Nomor Induk Siswa Nasional Harus Diisi',
            'nisn.min' => 'Kolom Nomor Induk Siswa Nasional Minimal 10 Digit',
            'nisn.max' => 'Kolom Nomor Induk Siswa Nasional Maksimal 10 Digit',
            'tglLhr.required' => 'Kolom Tanggal Lahir Harus Diisi',
            'telepon.required' => 'Kolom Nomor Telepon/HP Harus Diisi',
            'telepon.regex' => 'Kolom Nomor Telepon/HP Tidak Valid',
        ];
    }
}
