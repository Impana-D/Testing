@extends('prospect.layout')

@section('content')
<div class="prospect-card">
    <h2>Step 3: Prospect Preferences</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prospect.preferences.store') }}" method="POST">
        @csrf
        <input type="hidden" name="prospect_id" value="{{ session()->get('prospect_id') }}">

        <!-- Dietary Preference -->
        <div class="mb-3">
            <label class="form-label">Dietary Preference</label>
           <select name="dietary_preference" class="form-select">
    <option value="">Select Preference</option>
    <option value="Vegetarian" {{ old('dietary_preference') == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
    <option value="Eggetarian" {{ old('dietary_preference') == 'Eggetarian' ? 'selected' : '' }}>Eggetarian</option>
    <option value="Non-Vegetarian" {{ old('dietary_preference') == 'Non-Vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
    <!-- <option value="Vegan" {{ old('dietary_preference') == 'Vegan' ? 'selected' : '' }}>Vegan</option> -->
</select>

            @error('dietary_preference') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Health & Lifestyle Checkboxes -->
        <div class="mb-3">
            <label class="form-label">Health & Lifestyle Focus</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_health_conscious" value="1" {{ old('is_health_conscious') ? 'checked' : '' }}>
                <label class="form-check-label">Health Conscious</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_fitness_gym_going" value="1" {{ old('is_fitness_gym_going') ? 'checked' : '' }}>
                <label class="form-check-label">Fitness / Gym Going</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_kids_nutrition_focused" value="1" {{ old('is_kids_nutrition_focused') ? 'checked' : '' }}>
                <label class="form-check-label">Kids Nutrition Focused</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_elderly_care_focused" value="1" {{ old('is_elderly_care_focused') ? 'checked' : '' }}>
                <label class="form-check-label">Elderly Care Focused</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_weight_management" value="1" {{ old('is_weight_management') ? 'checked' : '' }}>
                <label class="form-check-label">Weight Management</label>
            </div>
        </div>

        <!-- Food Preferences -->
        <div class="mb-3">
            <label class="form-label">Food Preferences</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="pref_jain_food" value="1" {{ old('pref_jain_food') ? 'checked' : '' }}>
                <label class="form-check-label">Jain Food</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="pref_satvik_food" value="1" {{ old('pref_satvik_food') ? 'checked' : '' }}>
                <label class="form-check-label">Satvik Food</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="pref_no_onion_no_garlic" value="1" {{ old('pref_no_onion_no_garlic') ? 'checked' : '' }}>
                <label class="form-check-label">No Onion / No Garlic</label>
            </div>
        </div>

        <!-- Cuisine Selection (Multiple) -->
        <div class="mb-3">
    <label class="form-label">Preferred Cuisines</label>
    <div>
@foreach($cuisines as $cuisine)
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" 
               name="cuisine_id[]" value="{{ $cuisine->id }}"
               {{ in_array($cuisine->id, old('cuisine_id', [])) ? 'checked' : '' }}>
        <label class="form-check-label">{{ $cuisine->name }}</label>
    </div>
@endforeach

    </div>
    @error('cuisine_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>


        <!-- Value Sensitivity -->
        <div class="mb-3">
            <label class="form-label">Value Sensitivity</label>
            <select name="value_sensitivity" class="form-select">
                <option value="">Select Sensitivity</option>
                <option value="Cost-conscious" {{ old('value_sensitivity') == 'Cost-conscious' ? 'selected' : '' }}>Cost-conscious</option>
                <option value="Balanced" {{ old('value_sensitivity') == 'Balanced' ? 'selected' : '' }}>Balanced</option>
                <option value="Quality-conscious" {{ old('value_sensitivity') == 'Quality-conscious' ? 'selected' : '' }}>Quality-conscious</option>
            </select>
            @error('value_sensitivity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-next">Next →</button>
        </div>
    </form>
</div>
@endsection
