<?php

namespace App\Http\Requests\Variations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreVariationRequest extends FormRequest
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
            'product_id'  => ['required', 'numeric', 'min:1', 'exists:products,id'],
            'reference'   => ['required', 'string', 'min:2', 'max:50', 'unique:variations'],
            'description' => ['required', 'string', 'min:2', 'max:255'],
            'price'       => ['required', 'numeric', 'regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
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
