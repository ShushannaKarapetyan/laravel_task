@extends('layouts.app')

@section('content')
    <new></new>
@endsection

@push('scripts')
    <script src="{{ asset ('js/tenants.js') }}"></script>
@endpush
