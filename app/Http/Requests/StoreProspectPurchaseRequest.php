<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreProspectPurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prospect_id' => [
                'required',
                'integer',
                'exists:prospect_personal,id', // Ensure the prospect exists
            ],
            'monthly_budget' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'purchase_frequency' => [
                'nullable',
                Rule::in([
                    'Once a month',
                    'Once a week',
                    'Several days a week',
                    'Daily',
                ]),
            ],
            'status' => [
                'nullable',
                Rule::in(array_column(Status::cases(), 'value')), // Active/Inactive/Deleted
            ],
            'days' => [ // optional array of selected days (1 = Monday, 7 = Sunday)
                'nullable',
                'array',
            ],
            'days.*' => [
                'integer',
                'min:1',
                'max:7',
            ],
        ];
    }
}
