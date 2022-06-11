<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('delegate')->id;

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,{$id},id,deleted_at,NULL", 'min:3', 'max:255'],
            'password' => ['nullable', 'string', 'min:3', 'max:255'],
            'phone' => ['nullable', 'string', 'min:9', 'max:255'],
            'is_admin' => ['nullable', 'in:1']
        ];
    }
}
