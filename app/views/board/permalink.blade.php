@extends('frontend_master')

@section('content')
<div>
    <h1>Title: {{ $image->title }}</h1>
</div>
<h4>Photo: </h4>
<div>
{{ HTML::image(Config::get('image.upload_folder').$image->image) }}
</div>
<br/>
<div class="btn btn-danger">
    <a href="{{ URL::to('delete/'.$image->id) }}">Delte this photo?</a>
</div>
<h6>Direct Image URL: </h6>
<p>
<input type="text" value="{{ URL::to(Config::get('image.upload_folder').$image->image) }}"/>
</p>
<br/>
<h5>Thumbnail Forum BBCode </h5>
<input type="text" value="[url]= {{ URL::to('snatch/'.$image->id) }}][img]{{ URL::to(Config::get('image.upload_folder').'/'.$image->image) }}[/img][/url]"/>

<br/>
<h5>Thumbnail HTML Code: </h5>
<p>
<input type="text" value="{{ HTML::entities(HTML::link(URL::to('snatch/'.$image->id)),HTML::image(Config::get('image.upload_folder').'/'.$image->image) ) }}"/>
</p>

@stop