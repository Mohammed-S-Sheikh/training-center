<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadRequest extends FormRequest
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
        $id = $this->route('lead')->id;

        return [
            'name' => ['nullable', 'string', 'between:3,255'],
            'email'=> ['nullable', 'string', 'email', 'max:255', "unique:trainees,email,{$id},id,deleted_at,NULL"],
            'phone'=> ['nullable', 'string', 'between:9,255'],
            'ly'=> ['required', 'numeric'],
            'us'=> ['required', 'numeric'],
        ];
    }
}
