<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'state_id' => [
                'required', // city must belong to a state
                'integer',
                'exists:states,id', // ensure valid state
            ],
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:cities,name', // unique across all cities
            ],
            'status' => [
                'nullable',
                Rule::in(array_column(Status::cases(), 'value')), // optional enum
            ],
        ];
    }
}
