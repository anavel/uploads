@extends('anavel::layouts.simple')

@section('body-classes')
    sidebar-collapse
@stop
@section('footer')@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><i class="fa fa-upload"></i> {{ config('anavel-uploads.name') }}</li>
    @if ($previousDirectory !== null)
        @foreach ($directoriesArray as $directory)
            <li>{{ $directory }}</li>
        @endforeach
    @endif
</ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                {{ trans('anavel-uploads::messages.file_browser_title') }}
            </div>
        </div>
        <div class="box-body">
            @if ($previousDirectory !== null)
            <a href="{{ route('anavel-uploads.modal.file-browser', array_merge(Request::query(), ['dir' => $previousDirectory])) }}"><i class="fa fa-arrow-left"></i> {{ trans('anavel-uploads::messages.back_button') }}</a>
            @endif

            <div class="row">
                @foreach ($contents as $object)
                <div class="col-sm-4 col-md-2">
                    @if ($object->isDir())
                    <a href="{{ route('anavel-uploads.modal.file-browser', array_merge(Request::query(), ['dir' => $object->getPath()])) }}">
                        {!! $object->getThumbnail() !!}
                    </a>
                    @else
                    <div class="img-preview" data-url="{{ url(config('anavel-uploads.uploads_path').$object->getPath()) }}" onclick="returnFileUrl(this)">
                        {!! $object->getThumbnail() !!}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            {{ $object->getBasename() }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('footer-scripts')
    @parent

    <script>
        if(window.parent.fileSelector==undefined)
        {
            throw Error('Parent must have a fileSelector function');
        }
        // Helper function to get parameters from the query string.
        function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
            var match = window.location.search.match( reParam );

            return ( match && match.length > 1 ) ? match[1] : null;
        }
        // Simulate user action of selecting a file to be returned to CKEditor.
        function returnFileUrl(element) {
            var fileUrl = $(element).data('url');
            window.parent.fileSelector(fileUrl );
        }
    </script>
@stop