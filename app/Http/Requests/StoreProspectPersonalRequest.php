<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StoreProspectPersonalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    $isWeb = !$this->expectsJson(); // true for Blade forms

    return [
        'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z][A-Za-z ]*$/'],
        'mobile' => ['required', 'digits:10', 'regex:/^[6-9][0-9]{9}$/'],

        // For Web, these are required; for API, keep them nullable
        'customer_id' => [$isWeb ? 'required' : 'nullable', 'integer', 'exists:users,id'],
        'flat_no' => [$isWeb ? 'required' : 'nullable', 'string', 'max:50'],
        'floor' => [$isWeb ? 'required' : 'nullable', 'string', 'max:50'],
        'block_street' => [$isWeb ? 'required' : 'nullable', 'string', 'max:255'],
        'remarks' => [$isWeb ? 'required' : 'nullable', 'string', 'max:255'],
        'community_id' => [$isWeb ? 'required' : 'nullable', 'integer', 'exists:communities,id'],

        // These are always nullable
        'gps_location' => ['nullable', 'string', 'max:255'],
        'latitude' => ['nullable', 'numeric', 'between:-90,90'],
        'longitude' => ['nullable', 'numeric', 'between:-180,180'],
    ];
}


public function messages(): array
{
    if (!$this->expectsJson()) { // Web
        return config('messages.prospect_personal.validation', []);
    }

    // API custom messages (optional)
    return [
        'name.regex' => 'Invalid name format.',
        'mobile.regex' => 'Invalid mobile number.',
    ];
}

}
