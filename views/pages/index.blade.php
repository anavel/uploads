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
    <li><a href="{{ route('anavel-uploads.home') }}"><i class="fa fa-upload"></i> {{ config('anavel-uploads.name') }}</a></li>
</ol>
@stop

@section('content')

@stop