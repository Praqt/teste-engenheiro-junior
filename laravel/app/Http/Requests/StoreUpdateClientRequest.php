<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateClientRequest extends FormRequest
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
            "email" => ["required", "email", "unique:clients"],
            "name" => ["required", "min:3", "max:255"],
            "phone_number" => ["required", "min:8", "max:255"],
        ];
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['email'] = [
                "required",
                "email",
                Rule::unique("clients")->ignore($this->client ?? $this->id),
            ];
        }
        
        return $rules;
    }
}
