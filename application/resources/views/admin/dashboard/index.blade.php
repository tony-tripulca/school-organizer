@extends('layouts.admin.app')
@extends('layouts.admin.header')
@extends('layouts.admin.footer')

@section('plugin-styles')

@endsection

@section('module-styles')
    @if(config('app.env') == "production")
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.min.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    @endif
@endsection

@section('plugin-scripts')

@endsection

@section('module-scripts')
    @if(config('app.env') == "production")
		<script type="text/javascript" src="{{ asset('js/admin/dashboard.min.js') }}"></script>
    @else
		<script type="text/javascript" src="{{ asset('js/admin/dashboard.js') }}"></script>
    @endif
@endsection

@section('content')

@endsection