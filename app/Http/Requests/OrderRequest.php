<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SameProductTypeRule;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|min:1|max:255',
            'need_by_date' => 'required|date|after_or_equal:today', 
            'product' => ['required', 'array', 'min:1', new SameProductTypeRule],
            'quantities.*' => 'required|integer|min:1000',
        ];
    }
}
