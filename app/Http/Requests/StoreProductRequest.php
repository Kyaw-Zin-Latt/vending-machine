<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:products,name', // Ensure name is unique in the products table
            'price' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'quantity_available' => 'required|integer|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Product Name',
            'price' => 'Product Price',
            'user_id' => 'User',
            'currency_id' => 'Currency',
            'quantity_available' => 'Available Quantity',
        ];
    }
}
