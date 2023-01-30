<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateSectionRequest extends FormRequest
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
     * Get the validation rules that apply to the .
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'name' => ['required', 'string', 'max:50', Rule::unique(Section::class,'name')->ignore($request->id)],
        ];
    }
}
