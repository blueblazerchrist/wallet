<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RechargeWalletRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'document.required' => 'El campo documento es obligatorio.',
            'document.string' => 'El documento debe ser un texto válido.',
            'document.max' => 'El documento no puede superar los 50 caracteres.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.string' => 'El teléfono debe ser un texto válido.',
            'phone.max' => 'El teléfono no puede superar los 20 caracteres.',
            'amount.required' => 'El campo monto es obligatorio.',
            'amount.numeric' => 'El monto debe ser un número.',
            'amount.min' => 'El monto debe ser mayor o igual a 1.',
        ];
    }

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
