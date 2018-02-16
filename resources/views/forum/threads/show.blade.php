@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card border-dark text-white bg-dark mb-3">

            <div class="card-header">
                <h5 class="card-title">{{ $thread->title }}</h5>
            </div>

            <div class="card-body">
                <p class="card-text">
                    {{ $thread->body }}
                </p>
            </div>

            <div class="card-footer">
                <a href="/user/{{ $thread->user->id }}">
                    <small class="text-muted">{{ $thread->user->name }}</small>
                </a>
                <small class="text-muted float-right">{{ $thread->created_at->diffForHumans() }}</small>
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

    <div class="col-md-4 col-sm-12">
        <div class="card border-dark bg-secondary text-white">
            <div class="card-body">
                <p>sdfsdf</p>
            </div>
        </div>
    </div>
</div>
@endsection
