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
                    <small>{{ $thread->user->replies_count + $thread->user->threads_count }} {{ str_plural('post', $thread->user->replies_count + $thread->user->threads_count) }}</small>
                    
                </div>

                <div class="d-flex flex-column w-75">

                    <div class="card-body">
                        <p class="card-text">
                            {{ $thread->body }}
                        </p>
                    </div>

                    <div class="card-footer">
                        <span class="float-right">
                            {{ $thread->created_at->diffForHumans() }}
                        </span>
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
        
        @if(auth()->check())
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
        @endif

    </div>

</div>
@endsection
