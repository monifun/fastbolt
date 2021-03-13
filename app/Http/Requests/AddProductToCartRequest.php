<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductToCartRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'market' => ['required', 'exists:markets,name'],
            'seller_id' => ['required', 'string'],
            'seller_name' => ['required', 'string'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.name' => ['required', 'string'],
            'products.*.price' => ['required', 'numeric', 'min:1'],
            'products.*.quantity' => ['required', 'numeric', 'min:1'],
            'products.*.url' => ['nullable', 'url'],
            'products.*.image' => ['nullable', 'url'],
            'products.*.options.*.label' => ['sometimes', 'alpha_dash'],
            'products.*.options.*.value' => ['sometimes', 'alpha_dash'],
        ];
    }
}
