<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class StatusRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::in([
                    'pending',
                    'in_progress',
                    'completed',
                    'cancelled',
                    'rejected',
                    'approved',
                    'on_hold',
                    'failed',
                    'processing',
                ]),
                Rule::unique('statuses', 'name'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The status name is required.',
            'name.string' => 'The status name must be a string.',
            'name.in' => 'The status must be one of the allowed values: pending, in_progress, completed, cancelled, rejected, approved, on_hold, failed, or processing.',
            'name.unique' => 'This status already exists and cannot be duplicated.',
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
