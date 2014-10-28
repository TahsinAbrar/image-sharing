@extends('frontend_master')

@section('content')
@if(count($images))
<ul>
    @foreach($images as $image)
    <li>
    <a href="{{ URL::to('snatch/'.$image->id) }}">
    {{ HTML::image(Config::get('image.upload_folder').$image->image ) }}
    </a>
    </li>
    @endforeach
</ul>
<p>{{ $images->links() }}</p>
@else
{{--If no images are found on the database, we will show a no image found error message--}}
<p>No image uploaded yet, {{ HTML::link('/','Care to upload one?') }}</p>
@endif
@stop
