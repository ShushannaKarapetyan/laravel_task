@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Name</p>
                <h3>
                    {{ $tenant->name }}
                </h3>
                <p>Phone</p>
                <h3>
                    {{ $tenant->phone }}
                </h3>
                <p>Image</p>
                <h3>
                    <img src="{{ asset('storage/images') }}/{{ $tenant->image }}" width="200" height="100" alt="Image">
                </h3>
            </div>
        </div>
    </div>
@endsection
