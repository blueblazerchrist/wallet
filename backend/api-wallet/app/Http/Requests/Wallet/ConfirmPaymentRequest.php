<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfirmPaymentRequest extends FormRequest
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
            'sessionId' => 'required|string|max:255',
            'token' => 'required|string|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'sessionId.required' => 'El campo sessionId es obligatorio.',
            'sessionId.string' => 'El sessionId debe ser un texto válido.',
            'sessionId.max' => 'El sessionId no puede superar los 255 caracteres.',
            'token.required' => 'El campo token es obligatorio.',
            'token.string' => 'El token debe ser un texto válido.',
            'token.max' => 'El token no puede superar los 255 caracteres.',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'cod_error' => 422,
                'message_error' => 'Los datos proporcionados no son válidos.',
                'data' => $validator->errors(),
            ], 422)
        );
    }
}
