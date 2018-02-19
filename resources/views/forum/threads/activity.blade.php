@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-row justify-content-between">
            <h1 class="text-white">Latest Activity</h1>
            {{ $threads->links() }}
        </div>
    </div>
</div>

<div class="row">
    @foreach($threads as $thread)
        <div class="col-12">
            <div class="card border-dark text-white bg-dark mb-3">
                <div class="card-body">

                    <h5 class="card-title">
                        <a href="{{ $thread->path() }}" class="text-light">
                            {{ $thread->title }}
                        </a>
                        <span class="badge badge-secondary badge-pill float-right mx-2">
                            {{ $thread->replies_count }} 
                            {{ str_plural('comment', $thread->replies_count) }}
                        </span>
                    </h5>

                    @if (count($thread->latestReply))
                        <p class="card-text">
                            {{ $thread->latestReply->user->name }}
                            replied to 
                            {{ $thread->user->name }}'s 
                            thread in 
                            <a href="/forum/{{ $thread->category->slug }}">
                                {{ $thread->category->name }}
                            </a> 
                            {{ $thread->latestReply->created_at->diffForHumans() }}:
                        </p>
                        <p class="card-text text-muted">
                            " {{ str_limit($thread->latestReply->body, 200) }} "
                        </p>
                    @else
                        <p class="card-text">
                            {{ $thread->user->name }}
                            posted a new thread in 
                            <a href="/forum/{{ $thread->category->slug }}">
                                {{ $thread->category->name }}
                            </a> 
                            {{ $thread->created_at->diffForHumans() }}:
                        </p>
                        <p class="card-text text-muted">
                            " {{ str_limit($thread->body, 200) }} "
                        </p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
