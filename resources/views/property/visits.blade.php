@extends('layouts.app')

@section('content')
    <visits></visits>
@endsection

@push('scripts')
    <script src={{ asset('js/visits.js') }}></script>
@endpush
