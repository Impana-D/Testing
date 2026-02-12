@extends('prospect.layout')

@section('content')
<div class="prospect-card">
    <h2>Step 2: Prospect Household</h2>

    <form action="{{ route('prospect.household.store') }}" method="POST">
        @csrf
        <input type="hidden" name="prospect_id" value="{{ session('prospect_id') }}">

        <div class="mb-3">
            <label class="form-label">Number of Family Members</label>
            <input type="number" name="household_size" class="form-control"
                   value="{{ old('household_size') }}" min="0">
            @error('household_size') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Male Count</label>
                <input type="number" name="male_count" class="form-control" value="{{ old('male_count', 0) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Female Count</label>
                <input type="number" name="female_count" class="form-control" value="{{ old('female_count', 0) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Infants</label>
                <input type="number" name="infants" class="form-control" value="{{ old('infants', 0) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Children</label>
                <input type="number" name="children" class="form-control" value="{{ old('children', 0) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Adults</label>
                <input type="number" name="adults" class="form-control" value="{{ old('adults', 0) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Seniors</label>
                <input type="number" name="seniors" class="form-control" value="{{ old('seniors', 0) }}">
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-next">Next →</button>
        </div>
    </form>
</div>
@endsection
