@extends('layouts.app')

@section('content')

<div class = "card m-2 p-2">
<a href="/posts" class="btn btn-default btn-secondary">Back</a>

<h1> {{ $post->title }} </h1>
<div class="col-md-12">
    <img style="width:100%" src="{{ asset('storage/cover_images/' . $post->cover_image) }}" alt="">
</div>
<br>
<hr>
<small><b>Written at:</b> {{$post->created_at}}</small>
<hr>

<p><b>Content:</b> {{$post->content}}</p>
<hr>
@if(!Auth::guest())
    @if(Auth::user()->id==$post->user_id)
    <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
    <br>
    {!! Html::form()
        ->action(route('posts.destroy',$post->id))
        ->method('POST')
        ->class('pull-right')
        ->children([
            Html::hidden('_method','DELETE'),
            Html::submit('Delete')->class('btn btn-danger')
        ])
        ->render() !!}

        </div>
    @endif
@endif

@endsection
