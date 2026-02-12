<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreProspectHouseholdRequest extends FormRequest
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
                'exists:prospect_personal,id',
            ],
            'household_size' => ['required', 'integer', 'min:1', 'max:10'],
            'male_count' => ['required', 'integer', 'min:0', 'max:10'],
            'female_count' => ['required', 'integer', 'min:0', 'max:10'],
            'infants' => ['required', 'integer', 'min:0', 'max:5'],
            'children' => ['required', 'integer', 'min:0', 'max:5'],
            'adults' => ['required', 'integer', 'min:0', 'max:10'],
            'seniors' => ['required', 'integer', 'min:0', 'max:5'],
            'status' => [
                'nullable',
                Rule::in(array_column(Status::cases(), 'value')),
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $male = $this->input('male_count', 0);
            $female = $this->input('female_count', 0);
            $household = $this->input('household_size', 0);

            // Validate gender sum ≤ household size
            if (($male + $female) > $household) {
                $validator->errors()->add('male_count', 'Male + Female cannot exceed Household size.');
                $validator->errors()->add('female_count', 'Male + Female cannot exceed Household size.');
            }
        });
    }

    // Generate auto-tags based on age groups
    public function autoTags(): ?string
    {
        $tags = [];
        if ($this->infants > 0) $tags[] = 'Infants';
        if ($this->children > 0) $tags[] = 'Children';
        if ($this->adults > 0) $tags[] = 'Adults';
        if ($this->seniors > 0) $tags[] = 'Seniors';

        return $tags ? implode(', ', $tags) : null;
    }
}
