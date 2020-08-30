@extends('layouts.admin.app')
@extends('layouts.admin.header')
@extends('layouts.admin.footer')

@extends('admin.users.manage')
@extends('admin.users.create')
@extends('admin.users.read')
@extends('admin.users.update')
@extends('admin.users.delete')

@section('plugin-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/datatables.min.css') }}">
@endsection

@section('module-styles')
    @if(config('app.env') == "production")
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users.min.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users.css') }}">
    @endif
@endsection

@section('plugin-scripts')
<script type="text/javascript" src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
@endsection

@section('module-scripts')
    @if(config('app.env') == "production")
		<script type="text/javascript" src="{{ asset('js/admin/users.min.js') }}"></script>
    @else
		<script type="text/javascript" src="{{ asset('js/admin/users.js') }}"></script>
    @endif
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <p class="roboto-bold text-15">USERS | {{ ucwords($user_type ?? "all") }}</p>
        </div>
        <div class="offset-2 col-4 text-right">
            <div class="crumbs">
                <a href="{{ route('admin.base') }}" class="roboto-bold text-muted text-_9">Admin Panel &gt;</a>
                <a href="{{ route('admin.users.index') }}" class="roboto-bold text-muted text-_9">Users &gt;</a>
                <a href="{{ route('admin.users.index', ['type' => $user_type ?? 'all']) }}" class="roboto-bold text-muted text-_9">{{ ucwords($user_type ?? "View All") }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <div class="card shadow">
                <div class="card-body">
                    <form class="users-form" name="filter_form">
                        <input type="hidden" class="filter-input" name="user_type_id" value="{{ $user_type_id ?? ''}}">
                        <input type="hidden" class="filter-input" name="user_type" value="{{ $user_type ?? '' }}">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <span class="roboto-bold">Filters</span>
                            </div>
                            <div class="form-group col-12">
                                <small class="text-muted">Records</small>
                                <div class="form-check">
                                    <input type="checkbox" id="active" class="filter-input form-check-input" name="records" value="1"/>
                                    <label class="form-check-label" for="active"> Active</label>
                                </div>
                                <div class="form-check">
                                <input type="checkbox" id="deleted" class="filter-input form-check-input" name="records" value="0"/>
                                    <label class="form-check-label" for="deleted"> Deleted</label>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <small class="text-muted">Gender</small>
                                <div class="form-check">
                                    <input type="checkbox" id="male" class="filter-input form-check-input" name="gender" value="male"/>
                                    <label class="form-check-label" for="male"> Male</label>
                                </div>
                                <div class="form-check">
                                <input type="checkbox" id="female" class="filter-input form-check-input" name="gender" value="female"/>
                                    <label class="form-check-label" for="female"> Female</label>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <small class="text-muted">Incomplete</small>
                                <div class="form-check">
                                    <input type="checkbox" id="father-name" class="filter-input form-check-input" name="father_name" value/>
                                    <label class="form-check-label" for="father-name"> Father's name</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="mother-name" class="filter-input form-check-input" name="mother_name" value/>
                                    <label class="form-check-label" for="mother-name"> Mother's name</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="address" class="filter-input form-check-input" name="address" value/>
                                    <label class="form-check-label" for="address"> Home address</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="student-mobile" class="filter-input form-check-input" name="student_mobile" value/>
                                    <label class="form-check-label" for="student-mobile"> Student's mobile</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="parent-mobile" class="filter-input form-check-input" name="parent_mobile" value/>
                                    <label class="form-check-label" for="parent-mobile"> Parent's mobile</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-xl-9">
            <div class="card shadow">
                @isset($user_type)
                    <div class="card-header">
                        <button class="dynamic-add-button btn btn-material btn-success roboto-bold" data-toggle="modal" data-target="#create-user-modal">Add {{ ucwords($user_type) }}</button>
                    </div>
                @endisset
                <div class="card-body">
                    <table id="users-table" class="compact row-border hover order-column">
                        <thead>
                            <tr>
                                <th class="all">Name</th>
                                <th class="desktop">Email</th>
                                <th class="desktop">Mobile</th>
                                <th class="none">Gender</th>
                                <th class="none">Home Address</th>
                                <th class="none">Father's name</th>
                                <th class="none">Father's number</th>
                                <th class="none">Mother's name</th>
                                <th class="none">Mother's number</th>
                                <th class="not-mobile last">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection