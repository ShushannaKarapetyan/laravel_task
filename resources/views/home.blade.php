@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        User Dashboard
                    </div>
                    <div class="card-body">
                        <a href="{{route('properties.index')}}" class="btn btn-success">Properties</a>
                        <a href="{{route('tenants.index')}}" class="btn btn-success">Tenants</a>
                        <a href="{{route('tenancies.index')}}" class="btn btn-success">Tenancies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
