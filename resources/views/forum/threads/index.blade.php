@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h1 class="text-white">Browse</h1>

<div class="row">
    <div class="col-12">
        @foreach ($categories as $category)
            <div class="card border-dark text-white bg-dark mb-3">
                <div class="card-header">
                    {{ $category->name }}
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($category->children as $subcategory)
                            <li class="list-group-item bg-dark">
                                <a href="/forum/{{ $subcategory->slug }}">{{ $subcategory->name }}</a>
                                <p class="badge badge-secondary badge-pill float-right mx-2">
                                    {{ $subcategory->replies_count }} 
                                    {{ str_plural('comment', $subcategory->replies_count) }}
                                </p> 
                                <p class="badge badge-secondary badge-pill float-right mx-2">
                                    {{ $subcategory->threads_count }} 
                                    {{ str_plural('thread', $subcategory->threads_count) }}
                                </p> 
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
