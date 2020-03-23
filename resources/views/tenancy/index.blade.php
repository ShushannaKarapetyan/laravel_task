@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Tenancies</h3>
                        {{--@can('create_update_delete', $tenancies[0])--}}
                        <a href="{{ route('tenancies.create')}}" class="float-lg-right">Create New</a>
                        {{-- @endcan--}}
                        @if(session('success'))
                            <div class="alert alert-success mt-5">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($tenancies) > 0)
                            <table class="table hover table-striped">
                                <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Monthly Rent</th>
                                    {{--                                    @can('create_update_delete', $tenancies[0])--}}
                                    <th>Actions</th>
                                    {{--@endcan--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tenancies as $tenancy)
                                    <tr>
                                        <td>{{$tenancy->start_date}}</td>
                                        <td>{{$tenancy->end_date}}</td>
                                        <td>{{$tenancy->monthly_rent}}</td>
                                        <td>
                                            @can('create_update_delete', $tenancy)
                                                <a href="{{route('tenancies.edit',$tenancy)}}"
                                                   class="btn btn-warning float-left">Update</a>
                                                <div class="float-right">
                                                    <form id="delete-form-{{ $tenancy->id }}"
                                                          action="{{route('tenancies.destroy',$tenancy)}}" method="POST"
                                                          class="form-delete">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" class="btn btn-danger" onclick="
                                                            if(confirm('Are you sure? Do you want to delete this? :D')){
                                                            event.preventDefault(); document.getElementById('delete-form-{{$tenancy -> id}}').submit();}
                                                            else {
                                                            event.preventDefault()
                                                            }">
                                                            Delete
                                                        </a>
                                                    </form>
                                                </div>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h1>No tenancies yet.</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<script>
        let form_delete = document.getElementsByClassName("form-delete")[0].getAttribute("id");
        document.getElementsByClassName('delete-item')[0].addEventListener("click",
            function (event) {
                event.preventDefault();
                if (confirm('Are you sure? Do you want to delete this? :D')) {
                    document.getElementById(form_delete).submit();
                }else{
                    event.preventDefault()
                }
            },
            false);
    </script>--}}
@endsection
