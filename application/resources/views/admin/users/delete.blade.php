@section('delete-modal')
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