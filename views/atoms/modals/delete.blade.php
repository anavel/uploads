<div class="modal modal-danger fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="name" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{ trans('anavel-uploads::messages.modal_delete_title') }}</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('anavel-uploads::messages.modal_delete_text') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ trans('anavel-uploads::messages.cancel_button') }}</button>
                    <button type="submit" class="btn btn-outline">{{ trans('anavel-uploads::messages.confirm_button') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>