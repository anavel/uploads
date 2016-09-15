@extends('anavel::layouts.master')

@section('body-classes')
    sidebar-collapse
@stop

@section('content-header')
<h1>
    {{ config('anavel-uploads.name') }}
</h1>
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ route('anavel-uploads.list') }}"><i class="fa fa-upload"></i> {{ config('anavel-uploads.name') }}</a></li>
    @if ($previousDirectory !== null)
        @foreach ($directoriesArray as $directory)
            <li>{{ $directory }}</li>
        @endforeach
    @endif
</ol>
@stop

@section('content')
    @include('anavel-uploads::atoms.modals.create-dir', [
        'directoriesArray' => $directoriesArray
    ])

    @include('anavel-uploads::atoms.modals.upload-file', [
        'directoriesArray' => $directoriesArray
    ])

    @include('anavel-uploads::atoms.modals.delete')

    <div class="box">
        <div class="box-header">
            <div class="box-title">
                {{ trans('anavel-uploads::messages.file_browser_title') }}
            </div>
            <div class="box-tools">
                <div class="btn-group">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#create-dir-modal"><i class="fa fa-plus"></i> {{ trans('anavel-uploads::messages.create_directory') }}</a>
                </div>
                <div class="btn-group">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#upload-file-modal"><i class="fa fa-upload"></i> {{ trans('anavel-uploads::messages.upload_file') }}</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            @if ($previousDirectory !== null)
            <a href="{{ route('anavel-uploads.list', ['dir' => $previousDirectory]) }}"><i class="fa fa-arrow-left"></i> {{ trans('anavel-uploads::messages.back_button') }}</a>
            @endif

            <div class="row">
                @foreach ($contents as $object)
                <div class="col-sm-4 col-md-2">
                    @if ($object->isDir())
                    <a href="{{ route('anavel-uploads.list', ['dir' => $object->getPath()]) }}">
                    @else
                    <a href="{{ url(config('anavel-uploads.uploads_path').$object->getPath()) }}" class="img-preview" target="_blank">
                    @endif
                        {!! $object->getThumbnail() !!}
                    </a>

                    <div class="row">
                        <div class="col-sm-9">
                            {{ $object->getBasename() }}
                        </div>
                        <div class="col-sm-3">
                            @if ($object->isDir())
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-action="{{ route('anavel-uploads.destroy-dir') }}" data-element="{{ $object->getPath() }}"><i class="fa fa-trash-o"></i></a>
                            @else
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-action="{{ route('anavel-uploads.destroy-file') }}" data-element="{{ $object->getPath() }}"><i class="fa fa-trash-o"></i></a>
                            @endif
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
    <script src="{{ asset('vendor/anavel-uploads/js/modals.js') }}" type="text/javascript"></script>
@stop