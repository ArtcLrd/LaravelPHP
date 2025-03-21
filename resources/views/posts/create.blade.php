@extends('layouts.app')

@section('content')
<h1>Create a Post:</h1>

{!! Html::form()
    ->action(route('posts.store'))
    ->method('POST')
    ->attribute('enctype', 'multipart/form-data')
    ->children([
        Html::div()
        ->class('form-group')
        ->children([
            Html::label('Title', 'title')->class('fw-bold'),
            Html::input('text', 'title')->class('form-control')->placeholder('Title'),
        ]),
        Html::div()
        ->class('form-group')
        ->children([
            Html::label('Body', 'content'),
            Html::textarea('content')->class('form-control')->placeholder('Body'),
        ]),
        Html::div()
        ->class('form-group')
        ->children([
            Html::label('Cover Image', 'cover_image')->class('fw-bold'),
            Html::file('cover_image')->class('form-control'),
        ]),
        Html::submit('Submit')->class('btn btn-primary'),
    ])
    ->render() !!}
@endsection
