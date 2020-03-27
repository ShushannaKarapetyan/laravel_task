@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Tenancy
                        @if(session('success'))
                            <div class="alert alert-success mt-5">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <form action="{{route('tenancies.update',$tenancy)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="property">Select a property</label>
                                <select name="property_id" class="form-control">
                                    @foreach($properties as $property=>$value)
                                        <option value="{{$property}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tenant_id">Select a tenant</label>
                                <select name="tenant_id" class="form-control">
                                    @foreach($tenants as $tenant=>$value)
                                        <option value="{{$tenant}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control @error('period') is-invalid @enderror"
                                       name="start_date"
                                       value="{{Carbon\Carbon::parse($tenancy->start_date)->format('Y-m-d')}}">
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control @error('period') is-invalid @enderror"
                                       name="end_date"
                                       value="{{Carbon\Carbon::parse($tenancy->end_date)->format('Y-m-d')}}">
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('period')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="monthly_rent">Monthly Rent</label>
                                <input type="text" name="monthly_rent"
                                       class="form-control @error('monthly_rent') is-invalid @enderror"
                                       value="{{$tenancy->monthly_rent}}">
                                @error('monthly_rent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
