<?php

namespace App\Http\Requests;

use App\Enums\BreedEnum;
use App\Enums\SexEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class CreateCatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'sex' => ['required', 'string', new Enum(SexEnum::class)],
            'birthdate' => ['nullable', 'date'],
            'department_id' => ['nullable', 'string', 'exists:departments,id'],
            'guardian_id' => ['nullable', 'string', 'exists:employees,id'],
            'breed' => ['string', new Enum(BreedEnum::class)],
            'description' => ['nullable', 'string'],
            'sterilized' => ['bool']
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
