@extends('layouts.app')

@section('content')

<h1>Posts:</h1>
<hr>
@if(count($posts)> 0)
<div class = "card m-2 p-2">
<ul class="list-group list-group-flush">
@foreach($posts as $post)
    <div class="row">
        <div class="col-md-4">
            <img style="width:100%" src="{{ asset('storage/cover_images/' . $post->cover_image) }}" alt="">
        </div>
        <div class="col-md-8">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written at: {{$post->created_at}}</small>
        </div>
    </div>


@endforeach
</ul>
</div>
@else
<h3>Nothing to Post</h3>
@endif

@endsection
