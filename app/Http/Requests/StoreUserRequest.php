<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/'],
        'email' => ['required', 'email', 'regex:/^[\w._%+-]+@gmail\.com$/i', 'unique:users,email'],
        'mobile' => ['required', 'digits:10', 'regex:/^[6-9][0-9]{9}$/'],
        'status' => ['sometimes', Rule::in(array_column(Status::cases(), 'value'))],
    ];
}


    // Default values for fields
    protected function prepareForValidation()
    {
        if (!$this->has('status')) {
            $this->merge([
                'status' => Status::Active->value,
            ]);
        }
    }
}
