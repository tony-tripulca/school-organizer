@extends('layouts.admin.app')
@extends('layouts.admin.header')
@extends('layouts.admin.footer')

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
            <p class="roboto-bold text-15">USERS | {{ ucwords($user_type) }}</p>
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
                        <div class="form-row">
                            <div class="form-group col-12">
                                <span class="roboto-bold">Filters</span>
                            </div>
                            <div class="form-group col-12">
                                <small class="text-muted">Gender</small>
                                <div class="form-check">
                                    <input type="checkbox" id="male" class="filter-input form-check-input" name="male" value/>
                                    <label class="form-check-label" for="male"> Male</label>
                                </div>
                                <div class="form-check">
                                <input type="checkbox" id="female" class="filter-input form-check-input" name="female" value/>
                                    <label class="form-check-label" for="female"> Female</label>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <small class="text-muted">Incomplete</small>
                                <div class="form-check">
                                    <input type="checkbox" id="first-name" class="filter-input form-check-input" name="first_name" value/>
                                    <label class="form-check-label" for="first-name"> First name</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="last-name" class="filter-input form-check-input" name="last_name" value/>
                                    <label class="form-check-label" for="last-name"> Last name</label>
                                </div>
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
                        <button class="dynamic-add-button btn btn-material btn-success roboto-bold" data-toggle="modal" data-target="#add-user-modal">Add {{ ucwords($user_type) }}</button>
                    </div>
                @endisset
                <div class="card-body">
                    <table id="users-table" class="compact row-border hover order-column">
                        <thead>
                            <tr>
                                <th class="all">Name</th>
                                <th class="desktop">Email</th>
                                <th class="desktop">Mobile</th>
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

@section('modal')
<form class="users-form" name="add_user_form">
    <input type="hidden" name="user_type_id" value="{{ $user_type_id }}">
    <div class="modal users-modal fade" id="add-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content ajax-loader">
                <div class="modal-header">
                    @isset($user_type)
                        <p class="modal-title roboto-bold text-15">Add {{ ucwords($user_type) }}</p>
                    @endisset
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-5">
                            <small class="text-muted">Last name</small>
                            <input type="text" class="add-student-input form-control" name="last_name">
                        </div>
                        <div class="form-group col-7">
                            <small class="text-muted">First name</small>
                            <input type="text" class="add-student-input form-control" name="first_name">
                        </div>
                        <div class="form-group col-5">
                            <small class="text-muted">Middle name</small>
                            <input type="text" class="add-student-input form-control" name="middle_name">
                        </div>
                        <div class="form-group col-3">
                            <small class="text-muted">Suffix</small>
                            <input type="text" class="add-student-input form-control" name="suffix">
                        </div>
                        <div class="form-group col-4">
                            <small class="text-muted">Gender</small>
                            <select class="add-student-input custom-select" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <small class="text-muted">Home Address</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">location_on</i></span>
                                </div>
                                <input type="text" class="add-student-input form-control" name="full_address">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <small class="text-muted">Email Address</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">email</i></span>
                                </div>
                                <input type="text" class="add-student-input form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <small class="text-muted">Mobile number</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                </div>
                                <input type="text" class="add-student-input form-control" name="mobile">
                            </div>
                        </div>
                    </div>
                    @if($user_type == "student")
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Father's name</small>
                                <input type="text" class="add-student-input form-control" name="father_name">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Father's mobile</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                    </div>
                                    <input type="text" class="add-student-input form-control" name="father_mobile">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Mother's name</small>
                                <input type="text" class="add-student-input form-control" name="mother_name">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Mobile number</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                    </div>
                                    <input type="text" class="add-student-input form-control" name="mother_mobile">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-material btn-success">Save</button>
                    <button type="button" class="btn btn-material btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form class="users-form" name="manage_user_form">
    <input type="hidden" name="resource_id" value>
    <div class="modal users-modal fade" id="manage-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content ajax-loader">
                <div class="modal-header">
                    <p class="modal-title roboto-bold text-15">Manage User</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Work in progress...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-material btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form class="users-form" name="view_user_form">
    <input type="hidden" name="resource_id" value>
    <div class="modal users-modal fade" id="view-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content ajax-loader">
                <div class="modal-header">
                    <p class="modal-title roboto-bold text-15">View User</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Work in progress...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-material btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form class="users-form" name="edit_user_form">
    <input type="hidden" name="resource_id" value>
    <div class="modal users-modal fade" id="edit-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content ajax-loader">
                <div class="modal-header">
                    <p class="modal-title roboto-bold text-15">Edit User</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Work in progress...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-material btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form class="users-form" name="delete_user_form">
    <input type="hidden" name="resource_id" value>
    <div class="modal users-modal fade" id="delete-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content ajax-loader">
                <div class="modal-header">
                    <p class="modal-title roboto-bold text-15">Delete User</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="material-icons text-danger text-20">info_outline</i>
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-material btn-danger">Delete</button>
                    <button type="button" class="btn btn-material btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection