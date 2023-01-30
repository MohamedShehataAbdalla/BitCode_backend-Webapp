<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomerRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:30'],
            'middle_name' => ['nullable', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],

            // 'image' => ['nullable', 'image' , 'mimes:jpg,jpeg,png'],
            'dirth_date' => ['nullable', 'date'],

            'personal_id' => ['nullable', 'regex:/[0-9 \/]+/', 'min:14','max:20',],
            'mobile' => ['required', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{4})[-. ]*(\d{4})(?: *x(\d+))?\s*$/', 'min:11','max:15'],
        
        ];
    }
}
