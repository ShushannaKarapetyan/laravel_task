@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if(!auth()->user()->is_admin)
                    <div class="card-header">
                        User Dashboard
                    </div>
                    <div class="card-body">
                        <a href= "{{route('properties.index')}}" class="btn btn-success">Properties</a>
                        <a href="{{route('tenants.index')}}" class="btn btn-success">Tenants</a>
                        <a href="{{route('tenancies.index')}}" class="btn btn-success">Tenancies</a>
                    </div>
                    @else
                    <div class="card-header">
                        Admin dashboard
                    </div>
                    <div class="card-body">
                        <a href= "{{route('properties.index')}}" class="btn btn-success">Show Properties</a>
                        <a href="{{route('tenants.index')}}" class="btn btn-success">Show Tenants</a>
                        <a href="{{route('tenancies.index')}}" class="btn btn-success">Show Tenancies</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
