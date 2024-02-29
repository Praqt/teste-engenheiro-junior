<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateProductRequest extends FormRequest
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
        $rules = [
            "name" => ["required", "unique:products"],
            "price" => ["required", "numeric", "gt:0"],
            "stock" => ["required", "integer", "gte:0"]
        ];
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['name'] = [
                "required",
                Rule::unique("products")->ignore($this->product ?? $this->id),
            ];
        }
        
        return $rules;
    }
}
