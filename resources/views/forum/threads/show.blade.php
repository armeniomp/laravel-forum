@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-12">
        <h2 class="text-white">
            {{ $thread->title }}
        </h2>
        <span class="text-white">
            Posted by 
            <a href="/user/{{ $thread->user->id }}">{{ $thread->user->name }}</a> 
            {{ $thread->created_at->toFormattedDateString() }} 
            in 
            <a href="/forum/{{ $thread->category->name }}">{{ $thread->category->name }}</a>
        </span>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card border-dark text-white bg-dark mb-3">
            <div class="d-flex flex-row">
                
                <div class="card-header text-center w-25">

                    <h5>
                        <a href="/user/{{ $thread->user->id }}">
                            {{ $thread->user->name }}
                        </a>
                    </h5>

                    <img src="https://lorempixel.com/100/100/" class="rounded-circle">

                    <p>Member</p>

                    <p>
                        <small>
                            {{ $thread->user->posts }} 
                            {{ str_plural('post', $thread->user->posts) }}
                        </small>
                    </p>

                    <p>
                        <small>
                            {{ $thread->user->favorites }} 
                            {{ str_plural('like', $thread->user->favorites) }}
                        </small>
                    </p>
                </div>

                <div class="d-flex flex-column w-75">
                    
                    <div class="card-body d-flex flex-column">

                        <div class="pb-2">
                            <span>
                                {{ $thread->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <p class="card-text">
                            {{ $thread->body }}
                        </p>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            @if(!$thread->isOwner())
                                <form method="POST" action="/forum/threads/{{ $thread->id }}/like">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-{{ $thread->isFavorited() ? '' : 'outline-' }}success">
                                        <span class="badge badge-light">
                                            {{ $thread->favorites()->count() }}
                                        </span>
                                        Like
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-outline-success">
                                    <span class="badge badge-light">
                                        {{ $thread->favorites()->count() }}
                                    </span>
                                    Like
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card border-dark text-white bg-dark mb-3">

            @if ($replies->hasPages())
                <div class="card-header">
                    {{ $replies->links() }}
                </div>
            @endif

            @foreach($replies as $reply)
                @include('forum.threads.reply')
            @endforeach

            @if ($replies->hasPages())
                <div class="card-header">
                    {{ $replies->links() }}
                </div>
            @endif
        </div>
        
        @auth
            <form method="POST" action="{{ $thread->path() . '/replies' }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="body">Reply:</label>
                    <textarea name="body" id="body" class="form-control" rows="5"></textarea>
                </div>

                <button type="submit" class="btn btn-secondary">Reply</button>
            </form>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to reply to this thread.</p>
        @endauth

    </div>

</div>
@endsection
