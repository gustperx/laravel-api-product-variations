<?php

namespace App\Http\Requests\Variations;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVariationRequest extends FormRequest
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
            'product_id'  => ['nullable', 'numeric', 'min:1', 'exists:products,id'],
            'reference'   => ['nullable', 'string', 'min:2', 'max:50', Rule::unique('variations')->ignore($this->variation)],
            'description' => ['nullable', 'string', 'min:2', 'max:255'],
            'price'       => ['nullable', 'numeric', 'regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
