<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateForeignTraineeRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:3,255'],
            'email'=> ['nullable', 'string', 'email', 'max:255', 'unique:trainees,email,NULL,id,deleted_at,NULL'],
            'phone'=> ['nullable', 'string', 'between:9,12'],
            'ly'=> ['required', 'numeric'],
            'us'=> ['required', 'numeric'],
            'country_id'=> ['required', 'exists:countries,id'],
        ];
    }
}
