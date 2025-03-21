@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/posts/create" class="btn btn-primary">Create a Post</a>
                    <h3>Your Blog Post</h3>
                    @forelse($posts as $post)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a></td>
                                <td>
                                        {!! Html::form()
                                            ->action(route('posts.destroy',$post->id))
                                            ->method('POST')
                                            ->class('pull-right')
                                            ->children([
                                                Html::hidden('_method','DELETE'),
                                                Html::submit('Delete')->class('btn btn-danger')
                                            ])
                                            ->render() !!}
                                </td>
                            </tr>
                        </table>
                    @empty
                        <p>No posts yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
