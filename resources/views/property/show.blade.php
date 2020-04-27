@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Name</p>
                <h3>
                    {{ $property["name_{$locale}"] }}
                </h3>
                <p>Address</p>
                <h3>
                    {{ $property->address }}
                </h3>
                <p>Description</p>
                <h3>
                    {{ $property["description_$locale"] }}
                </h3>
                <p>Price</p>
                <h3>
                    {{ $property->price }}
                </h3>
            </div>
        </div>
    </div>
@endsection
