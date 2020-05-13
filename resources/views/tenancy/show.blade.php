@extends('layouts.app')

@section('content')
    <show></show>
@endsection

@push('scripts')
    <script src="{{ asset ('js/tenancies.js') }}"></script>
@endpush
