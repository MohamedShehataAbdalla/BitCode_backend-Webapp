<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateProductRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique(Product::class,'name')->ignore($request->id)],
            'barcode' => ['nullable', 'numeric', 'digits:13', Rule::unique(Product::class,'barcode')->ignore($request->id)],
            'price' => ['required', 'numeric'],
        ];
    }
}
