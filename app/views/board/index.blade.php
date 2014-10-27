@extends('frontend_master')

@section('content')
{{ Form::open(array('url' => '/', 'files' => true)) }}
{{ Form::text('title','', array('placeholder' => 'Please insert your title here')) }}
{{ Form::file('image') }}
{{ Form::submit('Save', array('name' => 'send')) }}

{{ Form::close() }}
@stop