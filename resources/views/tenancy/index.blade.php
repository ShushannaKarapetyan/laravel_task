@extends('layouts.app')

@section('content')
    <tenancies></tenancies>
@endsection

@push('scripts')
    <script src="{{ asset ('js/tenancies.js') }}"></script>
@endpush
