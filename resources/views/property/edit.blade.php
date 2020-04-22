@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Property
                    </div>
                    <form action="{{route('properties.update',$property)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name in English</label>
                                <input type="text"
                                       placeholder="Name"
                                       class="form-control {{$errors->has('name_en') ? 'is-invalid' : ''}}"
                                       name="name_en"
                                       value="{{$property->name_en}}">
                                @error('name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Name in Russian</label>
                                <input type="text"
                                       placeholder="Name"
                                       class="form-control {{$errors->has('name_ru') ? 'is-invalid' : ''}}"
                                       name="name_ru"
                                       value="{{$property->name_ru}}">
                                @error('name_ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text"
                                       placeholder="Address"
                                       class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                                       name="address"
                                       value="{{$property->address}}">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description in English</label>
                                <input type="text"
                                       placeholder="Description"
                                       class="form-control {{$errors->has('description_en') ? 'is-invalid' : ''}}"
                                       name="description_en"
                                       value="{{$property->description_en}}">
                                @error('description_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description in Russian</label>
                                <input type="text"
                                       placeholder="Description"
                                       class="form-control {{$errors->has('description_ru') ? 'is-invalid' : ''}}"
                                       name="description_ru"
                                       value="{{$property->description_ru}}">
                                @error('description_ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text"
                                       placeholder="Price"
                                       class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}"
                                       name="price"
                                       value="{{$property->price}}">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
