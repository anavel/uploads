<div class="modal fade" id="upload-file-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('anavel-uploads.upload-file') }}" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="parent" value="{{ implode('/', $directoriesArray) }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{ trans('anavel-uploads::messages.modal_upload_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2">{{ trans('anavel-uploads::messages.modal_upload_file_input_label') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="file" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('anavel-uploads::messages.cancel_button') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('anavel-uploads::messages.confirm_button') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>