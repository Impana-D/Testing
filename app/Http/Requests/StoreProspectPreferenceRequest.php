<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreProspectPreferenceRequest extends FormRequest
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
        'dietary_preference' => [
            'required',
            Rule::in(['Vegetarian', 'Eggetarian', 'Non-Vegetarian']),
        ],
        'is_health_conscious'       => 'nullable|boolean',
        'is_fitness_gym_going'      => 'nullable|boolean',
        'is_kids_nutrition_focused' => 'nullable|boolean',
        'is_elderly_care_focused'   => 'nullable|boolean',
        'is_weight_management'      => 'nullable|boolean',
        'pref_jain_food'            => 'nullable|boolean',
        'pref_satvik_food'          => 'nullable|boolean',
        'pref_no_onion_no_garlic'   => 'nullable|boolean',

        // <-- Replace previous cuisine_id validation with this
        'cuisine_id'   => ['nullable', 'array'],
        'cuisine_id.*' => ['integer', 'exists:cuisines,id'],

        'value_sensitivity' => [
            'nullable',
            Rule::in(['Cost-conscious', 'Balanced', 'Quality-conscious']),
        ],
        'status' => [
            'nullable',
            Rule::in(array_column(Status::cases(), 'value')),
        ],
    ];
}

}
