@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Tenancy
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <form action="{{route('tenancies.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="property">Select a property</label>
                                <select name="property_id" class="form-control">
                                    @foreach($properties as $property)
                                        <option value="{{$property->id}}">{{$property->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tenant_id">Select a tenant</label>
                                <select name="tenant_id" class="form-control">
                                    @foreach($tenants as $tenant)
                                        <option value="{{$tenant->id}}">{{$tenant->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date">
                                @error('start_date')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date">
                                @error('end_date')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="monthly_rent">Monthly Rent</label>
                                <input type="text" name="monthly_rent" class="form-control">
                                @error('monthly_rent')
                                    <p style="color: red">{{$message}}</p>
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
