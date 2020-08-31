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
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <p class="roboto-bold text-15">{{ $page_title }}</p>
        </div>
        <div class="col-12 col-md-6 text-right">
            <div class="crumbs d-none d-md-block">
                <a href="{{ route('admin.base') }}" class="roboto-bold text-muted text-_9">Admin Panel &gt;</a>
                <a href="{{ route('admin.dashboard') }}" class="roboto-bold text-muted text-_9">Dashboard</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card widget">
                <div class="card-body">
                    <span class="icon bg-verylightgrey"><i class="ti-user"></i></span>
                    <p class="card-text count">12</p>
                    <p class="card-text title">Students</p>
                    <p class="card-text description">Registered students</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card widget">
                <div class="card-body">
                    <span class="icon bg-verylightgrey"><i class="ti-notepad"></i></span>
                    <p class="card-text count">7</p>
                    <p class="card-text title">Profiles</p>
                    <p class="card-text description">Completed profiles</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection