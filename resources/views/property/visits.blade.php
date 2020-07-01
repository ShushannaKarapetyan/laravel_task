@extends('layouts.app')

@section('content')
    <period-selection></period-selection>
@endsection

@push('scripts')
    <script src={{ asset('js/visits.js') }}></script>
@endpush
