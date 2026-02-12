<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreRolesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/',
                'unique:roles,name',
            ],

            'description' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'sometimes',
                Rule::in(array_column(Status::cases(), 'value')),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->has('status')) {
            $this->merge([
                'status' => Status::Active->value,
            ]);
        }
    }
}
