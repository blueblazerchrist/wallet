<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckBalanceRequest extends FormRequest
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
            'document' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'document.required' => 'El campo documento es obligatorio.',
            'document.string' => 'El documento debe ser un texto válido.',
            'document.max' => 'El documento no puede superar los 50 caracteres.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.string' => 'El teléfono debe ser un texto válido.',
            'phone.max' => 'El teléfono no puede superar los 20 caracteres.',
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
