@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Tenancy
                    </div>
                    <form action="{{route('tenancies.store')}}" method="POST">
                        @csrf
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
                                <input type="date"
                                       class="form-control {{($errors->has('period') or $errors->has('start_date')) ? 'is-invalid' : ''}}"
                                       name="start_date"
                                       value="{{old('start_date')}}">
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date"
                                       class="form-control {{($errors->has('period') or $errors->has('end_date')) ? 'is-invalid' : ''}}"
                                       name="end_date"
                                       value="{{old('end_date')}}">
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
                                <input type="text"
                                       name="monthly_rent"
                                       placeholder="Monthly Rent"
                                       class="form-control {{$errors->has('monthly_rent') ? 'is-invalid' : ''}}"
                                       value="{{old('monthly_rent')}}">
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
