<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'between:3,255'],
            'email' => ['required', 'email', 'unique:users,email,NULL,id,deleted_at,NULL', 'between:3,255'],
            'password' => ['required', 'string', 'between:3,255', 'confirmed'],
            'phone' => ['nullable', 'string', 'digits:9'],
            'is_admin' => ['nullable', 'in:1']
        ];
    }
}
