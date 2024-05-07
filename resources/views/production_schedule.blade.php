@extends('layouts.base')

{{-- using tailwind CSS via CDN for simplicity --}}
@section('content')
    @include('components.production_table', $schedule)
    @include('components.production_timeline', $schedule)
@endsection