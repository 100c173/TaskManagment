<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'role' => 'required|string|in:super_admin,moderator,limited_admin,user' ,
        ];
    }
    /**
     * Custom messages for validation errors (optional).
     */
    public function messages(): array
    {
        return [
            'role.required' => 'The role field is required.',
            'role.string' => 'The role must be a string.',
            'role.in' => 'The selected role is invalid. Allowed roles: super_admin,moderator,limited_admin, user',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed.',
            'errors' => $validator->errors()
        ], 422));
    }
}
