@extends('prospect.layout')

@section('content')
<div class="prospect-card">
    <h2>Step 4: Prospect Purchase</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prospect.purchase.store') }}" method="POST">
        @csrf
        <input type="hidden" name="prospect_id" value="{{ session('prospect_id') }}">

        <!-- Monthly Budget -->
        <div class="mb-3">
            <label class="form-label">Monthly Budget</label>
            <input type="number" name="monthly_budget" class="form-control" 
                   value="{{ old('monthly_budget') }}" min="0" step="0.01">
            @error('monthly_budget') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Purchase Frequency -->
        <div class="mb-3">
            <label class="form-label">Purchase Frequency</label>
            <select name="purchase_frequency" class="form-select">
                <option value="">Select Frequency</option>
                <option value="Once a month" {{ old('purchase_frequency') == 'Once a month' ? 'selected' : '' }}>Once a month</option>
                <option value="Once a week" {{ old('purchase_frequency') == 'Once a week' ? 'selected' : '' }}>Once a week</option>
                <option value="Several days a week" {{ old('purchase_frequency') == 'Several days a week' ? 'selected' : '' }}>Several days a week</option>
                <option value="Daily" {{ old('purchase_frequency') == 'Daily' ? 'selected' : '' }}>Daily</option>
            </select>
            @error('purchase_frequency') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Days of Purchase -->
        <div class="mb-3">
            <label class="form-label">Select Days for Purchase</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="1" {{ in_array(1, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Monday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="2" {{ in_array(2, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Tuesday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="3" {{ in_array(3, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Wednesday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="4" {{ in_array(4, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Thursday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="5" {{ in_array(5, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Friday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="6" {{ in_array(6, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Saturday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" value="7" {{ in_array(7, old('days', [])) ? 'checked' : '' }}>
                <label class="form-check-label">Sunday</label>
            </div>
            @error('days') <div class="text-danger">{{ $message }}</div> @enderror
            @error('days.*') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-next">Submit →</button>
        </div>
    </form>
</div>
@endsection
