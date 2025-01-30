<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'code' => 'required|string|max:50|unique:sales,code',
            // 'monto' => 'required|numeric|min:0',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            // 'product_id' => 'required|exists:products,id',
            // 'quantity' => 'required|integer|min:1'
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];

    }
}
