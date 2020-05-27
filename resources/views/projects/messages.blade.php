@extends('layouts.app')

@section('content')
    <Messages/>
@endsection

@push('scripts')
    <script src="{{ asset ('js/messages.js') }}"></script>
@endpush
