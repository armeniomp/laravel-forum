@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card border-dark text-white bg-dark">
                <div class="card-header">New Thread</div>

                <div class="card-body">
                    @if (count($errors))
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="POST" action="/forum/threads">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control" required>
                                <option value="" disabled selected>Choose a Category...</option>
                                {{ FormCategorySelect() }}
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="title" value="{{ old('title') }}">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="body">Body</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control" value="{{ old('body') }}" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-secondary">Create Thread</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
