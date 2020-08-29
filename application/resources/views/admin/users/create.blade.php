@section('create-modal')
<form class="users-form" name="create_user_form">
    <input type="hidden" name="user_type_id" value="{{ $user_type_id }}">
    <div class="modal users-modal fade" id="create-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
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
                            <input type="text" class="create-input form-control" name="last_name">
                        </div>
                        <div class="form-group col-7">
                            <small class="text-muted">First name</small>
                            <input type="text" class="create-input form-control" name="first_name">
                        </div>
                        <div class="form-group col-5">
                            <small class="text-muted">Middle name</small>
                            <input type="text" class="create-input form-control" name="middle_name">
                        </div>
                        <div class="form-group col-3">
                            <small class="text-muted">Suffix</small>
                            <input type="text" class="create-input form-control" name="suffix">
                        </div>
                        <div class="form-group col-4">
                            <small class="text-muted">Gender</small>
                            <select class="create-input custom-select" name="gender">
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
                                <input type="text" class="create-input form-control" name="full_address">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <small class="text-muted">Email Address</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">email</i></span>
                                </div>
                                <input type="text" class="create-input form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <small class="text-muted">Mobile number</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                </div>
                                <input type="text" class="create-input form-control" name="mobile">
                            </div>
                        </div>
                    </div>
                    @if($user_type == "student")
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Father's name</small>
                                <input type="text" class="create-input form-control" name="father_name">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Father's mobile</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                    </div>
                                    <input type="text" class="create-input form-control" name="father_mobile">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Mother's name</small>
                                <input type="text" class="create-input form-control" name="mother_name">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <small class="text-muted">Mobile number</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                    </div>
                                    <input type="text" class="create-input form-control" name="mother_mobile">
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
@endsection