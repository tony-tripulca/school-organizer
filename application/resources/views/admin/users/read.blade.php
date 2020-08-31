@section('read-modal')
<form class="users-form" name="read_user_form">
    <div class="modal users-modal fade" id="read-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content ajax-loader">
                <div class="modal-header">
                    <p class="modal-title roboto-bold text-15">View User</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <small class="text-muted">Name</small>
                            <input type="text" class="read-input form-control" name="name" value disabled>
                        </div>
                        <div class="form-group col-12">
                            <small class="text-muted">Home Address</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">location_on</i></span>
                                </div>
                                <input type="text" class="read-input form-control" name="full_address" value disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <small class="text-muted">Email</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">email</i></span>
                                </div>
                                <input type="text" class="read-input form-control" name="email_address" value disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <small class="text-muted">Mobile</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                </div>
                                <input type="text" class="read-input form-control" name="mobile" value disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-7">
                            <small class="text-muted">Father</small>
                            <input type="text" class="read-input form-control" name="father_name" value disabled>
                        </div>
                        <div class="form-group col-12 col-md-5">
                            <small class="text-muted">Mobile</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                </div>
                                <input type="text" class="read-input form-control" name="father_mobile" value disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-7">
                            <small class="text-muted">Mother</small>
                            <input type="text" class="read-input form-control" name="mother_name" value disabled>
                        </div>
                        <div class="form-group col-12 col-md-5">
                            <small class="text-muted">Mobile</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">phone_android</i></span>
                                </div>
                                <input type="text" class="read-input form-control" name="mother_mobile" value disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-material btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection