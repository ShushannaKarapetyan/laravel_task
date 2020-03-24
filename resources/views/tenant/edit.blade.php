@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Tenant
                        @if(session('success'))
                            <div class="alert alert-success mt-5">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <form action="{{route('tenants.update',$tenant)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$tenant->name}}">
                                @error('name')
                                <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{$tenant->phone}}">
                                @error('phone')
                                <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                                @error('image')
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
