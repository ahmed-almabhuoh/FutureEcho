<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
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
            //
            "fname" => "required|string|min:2|max:45",
            "lname" => "required|string|min:2|max:45",
            "phone" => "required|string|min:7|max:45|unique:users,phone",
            "email" => "required|email|unique:users,email",
            "address1" => "nullable|string",
            "address2" => "nullable|string",
            "postcode" => "nullable|string",
            "city" => "nullable|string",
            "state" => "nullable|string",
            "country" => "required|string",
            "delivery" => "nullable|string",
            "packaging" => "nullable|string",
            "preferreddelivery" => "nullable|string",
        ];
    }
}
