@extends('layouts.app')

@section('content')
    <edit></edit>
@endsection

@push('scripts')
    <script src="{{ asset ('js/tenants.js') }}"></script>
@endpush
