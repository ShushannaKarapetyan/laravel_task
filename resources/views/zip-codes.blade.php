@extends('layouts.app')

@section('content')
    <Zip-Code/>
@endsection

@push('scripts')
    <script src="{{ asset ('js/zip-code.js') }}"></script>
@endpush
