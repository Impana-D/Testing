<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreCommunityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_id' => [
                'required',           // community must belong to a city
                'integer',
                'exists:cities,id',   // ensure valid city
            ],
            'community_name' => [
                'required',
                'string',
                'max:150',
                'unique:communities,community_name',
            ],
            'status' => [
                'nullable', // optional, defaults to Active
                Rule::in(array_column(Status::cases(), 'value')),
            ],
        ];
    }
}
