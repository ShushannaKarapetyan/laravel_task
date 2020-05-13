@extends('layouts.app')

@section('content')
    <tenants></tenants>
@endsection

@push('scripts')
    <script src="{{ asset ('js/tenants.js') }}"></script>
@endpush
