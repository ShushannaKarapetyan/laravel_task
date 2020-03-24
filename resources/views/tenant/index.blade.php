@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Tenants</h3>
                        <a href="{{ route('tenants.create')}}" class="float-lg-right">Create New</a>
                        @if(session('success'))
                            <div class="alert alert-success mt-5">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($tenants) > 0)
                            <table class="table hover table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tenants as $tenant)
                                    <tr>
                                        <td>
                                            <a href="{{route('tenants.show',$tenant)}}" style="color: black">
                                                {{$tenant->name}}
                                            </a>
                                        </td>
                                        <td>{{$tenant->phone}}</td>
                                        @if($tenant->image)
                                            <td>
                                                <img src="{{asset('storage/images')}}/{{$tenant->image}}" width="150"
                                                     height="70">
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <a href="{{route('tenants.edit',$tenant)}}"
                                               class="btn btn-warning float-left">Update</a>
                                            <div class="float-right">
                                                <form id="delete-form-{{$tenant->id}}"
                                                      action="{{route('tenants.destroy',$tenant)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" class="btn btn-danger" onclick="
                                                        if(confirm('Are you sure? Do you want to delete this? :D')){
                                                        event.preventDefault(); document.getElementById('delete-form-{{$tenant -> id}}').submit();}
                                                        else {
                                                        event.preventDefault()
                                                        }">
                                                        Delete
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h1>No tenants yet.</h1>
                        @endif
                        {{ $tenants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
