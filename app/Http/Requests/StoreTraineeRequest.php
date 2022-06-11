<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTraineeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'email'=> ['nullable', 'string', 'email', 'max:255', 'unique:trainees,email,NULL,id,deleted_at,NULL'],
            'phone'=> ['nullable', 'string', 'between:9,12'],
            'amount'=> ['nullable', 'numeric'],
            'discount'=> ['nullable', 'numeric', 'between:0,100'],
        ];
    }
}
