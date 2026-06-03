<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePenomoranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'penomoran' => [
                'required',
                'regex:/^[0-9]+$/',
                'integer',
                'min:1',
                'digits_between:1,6',
                Rule::unique('penomoran', 'penomoran')->ignore($this->input('id')),
            ],
            'tanggal_pibk' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'penomoran.required' => 'Nomor penomoran wajib diisi.',
            'penomoran.regex' => 'Nomor penomoran hanya boleh berisi angka tanpa huruf, spasi, desimal, atau simbol.',
            'penomoran.integer' => 'Nomor penomoran harus berupa angka bulat tanpa desimal.',
            'penomoran.min' => 'Nomor penomoran harus minimal 1.',
            'penomoran.digits_between' => 'Nomor penomoran boleh maksimal 6 digit.',
            'penomoran.unique' => 'Nomor penomoran sudah digunakan.',
            'tanggal_pibk.date' => 'Tanggal PIBK harus berupa tanggal yang valid.',
        ];
    }
}
