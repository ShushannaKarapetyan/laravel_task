@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Properties</h3>
                        {{-- @can('create_update_delete', $properties[0])--}}
                        <a href="{{ route('properties.create')}}" class="float-lg-right">Create New</a>
                        {{--  @endcan--}}
                        @if(session('success'))
                            <div class="alert alert-success mt-5">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($properties) > 0)
                            <table class="table hover table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    @can('create_update_delete', $properties[0])
                                        <th>Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($properties as $property)
                                    <tr>
                                        <td>
                                            {{-- <a href="{{route('properties.show',$property)}}" style="color: black">--}}
                                            {{$property->name}}
                                            {{--</a>--}}
                                        </td>
                                        <td>{{$property->address}}</td>
                                        <td>{{$property->description}}</td>
                                        <td>{{$property->price}}</td>
                                        @can('create_update_delete', $property)
                                            <td>
                                                <a href="{{route('properties.edit',$property)}}"
                                                   class="btn btn-warning float-left">Update</a>
                                                <div class="float-right">
                                                    <form id="delete-form-{{$property->id}}"
                                                          action="{{route('properties.destroy',$property)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" class="btn btn-danger" onclick="
                                                            if(confirm('Are you sure? Do you want to delete this? :D')){
                                                            event.preventDefault(); document.getElementById('delete-form-{{$property -> id}}').submit();}
                                                            else {
                                                            event.preventDefault()
                                                            }">
                                                            Delete
                                                        </a>
                                                    </form>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h1>No properties yet.</h1>
                        @endif
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
