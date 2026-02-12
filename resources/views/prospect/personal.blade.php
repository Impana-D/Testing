@extends('prospect.layout')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="prospect-card">

    <form action="{{ route('prospect.personal.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control"
                       value="{{ old('mobile') }}" required>
                @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Flat No</label>
                <input type="text" name="flat_no" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Floor</label>
                <input type="text" name="floor" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Block / Street</label>
                <input type="text" name="block_street" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <input type="text" name="remarks" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Community</label>
            <select name="community_id" class="form-select">
                <option value="">Select Community</option>
                @foreach($communities as $community)
                    <option value="{{ $community->id }}">
                        {{ $community->community_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="gps_location" value="-" />
       <input type="hidden" name="latitude" value="">
        <input type="hidden" name="longitude" value="">


        <div class="text-end">
            <button type="submit" class="btn btn-next">
                Next →
            </button>
        </div>

    </form>

</div>

@endsection
