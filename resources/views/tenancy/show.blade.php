@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Tenant</p>
                <h3>
                    {{ $tenancy->tenant->name }}
                </h3>
                <p>Property</p>
                <h3>
                    {{ $tenancy->property->name }}
                </h3>
                <p>Start Date</p>
                <h3>
                    {{ $tenancy->start_date->format('j,F,Y') }}
                </h3>
                <p>End Date</p>
                <h3>
                    {{ $tenancy->end_date->format('j,F,Y') }}
                </h3>
                <p>Monthly Rent</p>
                <h3>
                    {{ $tenancy->monthly_rent }}
                </h3>
            </div>
        </div>
    </div>
@endsection
