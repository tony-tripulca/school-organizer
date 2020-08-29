@section('manage-modal')
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
@endsection