<?php

namespace App\Http\Requests\Fakultas;

use Illuminate\Foundation\Http\FormRequest;

class FakultasUpdateRequest extends FormRequest
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
            'nmFakultas' => 'required',
            'isAktif' => 'required',
            'akreditasi' => 'required',
            'linkWebFakultas' => 'sometimes|nullable|regex:'.$regex,
            'linkWebAkreditasiFakultas' => 'sometimes|nullable|regex:'.$regex
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
            'nmFakultas.required' => 'Kolom Nama Fakultas Harus Diisi',
            'isAktif.required' => 'Pilih Status Aktif Fakultas',
            'akreditasi.required' => 'Pilih Akreditasi Fakultas',
            'linkWebFakultas.regex' => 'Format Link Website Fakultas Salah',
            'linkWebAkreditasiFakultas.regex' => 'Format Link Akreditasi Fakultas Salah'
        ];
    }
}
