@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h1 class="text-white text-center">{{ $category->name }}</h1>

@if(count($category->children))
<div class="row">
    <div class="col-12">
        <div class="card border-dark text-white bg-dark mb-3">
            <div class="card-header">
                <h5>Sub-Categories</h5>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($category->children as $subcategory)
                    <li class="list-group-item bg-dark">
                        <a href="/forum/{{ $subcategory->slug }}">{{ $subcategory->name }}</a>
                        <span class="badge badge-secondary badge-pill float-right mx-2">
                                {{ $subcategory->replies_count }} 
                                {{ str_plural('comment', $subcategory->replies_count) }}
                            </span> 
                            <span class="badge badge-secondary badge-pill float-right mx-2">
                                {{ $subcategory->threads_count }} 
                                {{ str_plural('thread', $subcategory->threads_count) }}
                            </span> 
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<h3 class="text-white border-bottom">Threads</h3>
<div class="row">
    @foreach($category->threads as $thread)
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
