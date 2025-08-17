<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'redes' => ['nullable', 'array'],
            'redes.instagram' => ['nullable', 'string', 'max:255'],
            'redes.facebook' => ['nullable', 'string', 'max:255'],
            'redes.tiktok' => ['nullable', 'string', 'max:255'],
            'redes.youtube' => ['nullable', 'string', 'max:255'],
            'redes.twitter' => ['nullable', 'string', 'max:255'],
            'redes.whatsapp' => ['nullable', 'string', 'max:255'],
        ];
    }
}
