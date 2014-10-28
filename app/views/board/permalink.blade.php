@extends('...frontend_master')

@section('content')
<div>
    <h1>Title: {{ $image->title }}</h1>
</div>
<h4>Image: </h4>
<br/>
<div>
{{ HTML::image(Config::get('image.upload_folder').$image->image) }}
</div>
<br/>
<h6>Direct Image URL: </h6>
<p> {{ URL::to(Config::get('image.upload_folder').$image->image) }}</p>
<br/>
<h5>Thumbnail Forum BBCode </h5>
[url]= {{ URL::to('snatch/'.$image->id) }}][img]{{ URL::to(Config::get('image.upload_folder').'/'.$image->image) }}[/img][/url]

<br/>
<h5>Thumbnail HTML Code: </h5>
<p>
{{ HTML::entities(HTML::link(URL::to('snatch/'.$image->id)),HTML::image(Config::get('image.upload_folder').'/'.$image->image) ) }}
</p>

@stop