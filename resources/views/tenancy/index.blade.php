@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Tenancies</h3>
                        <a href="{{ route('tenancies.create')}}" class="float-lg-right">Create New</a>
                        @if(session('success'))
                            <div class="alert alert-success mt-5">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($tenancies))
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Property</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Monthly Rent</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tenancies as $tenancy)
                                    <tr>
                                        <td>{{ $tenancy->tenant->name }}</td>
                                        <td>{{ $tenancy->property->name }}</td>
                                        <td>{{ $tenancy->start_date->format('j,F,Y') }}</td>
                                        <td>{{ $tenancy->end_date->format('j,F,Y') }}</td>
                                        <td>{{ $tenancy->monthly_rent }}</td>
                                        <td class="d-flex justify-content-between">
                                            <a href="{{ route('tenancies.show', $tenancy) }}"
                                               class="btn btn-primary">Show</a>
                                            <a href="{{ route('tenancies.edit', $tenancy) }}"
                                               class="btn btn-warning float-left">Edit</a>
                                            <div class="float-right">
                                                <form id="delete-form-{{ $tenancy->id }}"
                                                      action="{{ route('tenancies.destroy', $tenancy) }}" method="POST"
                                                      class="form-delete">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" class="btn btn-danger" onclick="
                                                        if(confirm('Do you want to delete this?')){
                                                        event.preventDefault(); document.getElementById('delete-form-{{ $tenancy->id }}').submit();}
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
                            <h1>No tenancies yet.</h1>
                        @endif
                        {{ $tenancies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
