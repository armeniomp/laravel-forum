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
            <h1 class="text-white">{{ $searchTerms or "Latest Threads" }}</h1>
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

                    <p class="card-text">
                        {{ str_limit($thread->body, 200) }}
                    </p>

                    <p class="card-text">
                        <small class="text-muted"></small>
                    </p>

                </div>

                <div class="card-footer">

                    <a href="/user/{{ $thread->user->id }}">
                        <small class="text-muted">{{ $thread->user->name }}</small>
                    </a>

                    <small class="text-muted float-right">{{ $thread->created_at->diffForHumans() }}</small>

                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
