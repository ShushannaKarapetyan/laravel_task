@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Property
                    </div>
                    <form action="{{ route('properties.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name in English</label>
                                <input type="text"
                                       placeholder="Name"
                                       value=" {{ old('name_en') }}"
                                       class="form-control {{ $errors->has('name_en') ? 'is-invalid' :'' }}"
                                       name="name_en">
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
                                       value=" {{ old('name_ru') }}"
                                       class="form-control {{ $errors->has('name_ru') ? 'is-invalid' :'' }}"
                                       name="name_ru">
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
                                       value=" {{ old('address') }}"
                                       class="form-control {{ $errors->has('address') ? 'is-invalid' :'' }}"
                                       name="address">
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
                                       value=" {{ old('description_en') }}"
                                       class="form-control {{ $errors->has('description_en') ? 'is-invalid' :'' }}"
                                       name="description_en">
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
                                       value=" {{ old('description_ru') }}"
                                       class="form-control {{ $errors->has('description_ru') ? 'is-invalid' :'' }}"
                                       name="description_ru">
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
                                       value=" {{ old('price') }}"
                                       class="form-control {{ $errors->has('price') ? 'is-invalid' :'' }}"
                                       name="price">
                                @error('price')
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
