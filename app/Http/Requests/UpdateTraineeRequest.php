<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTraineeRequest extends FormRequest
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
        $id = $this->route('trainee')->id;

        return [
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'email'=> ['nullable', 'string', 'email', 'max:255', "unique:trainees,email,{$id},id,deleted_at,NULL"],
            'phone'=> ['nullable', 'string', 'min:9', 'max:255'],
            'amount'=> ['nullable', 'numeric'],
            'discount'=> ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
