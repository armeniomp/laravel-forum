<div class="d-flex flex-row border-secondary border-bottom">
                
    <div class="card-header border-secondary border-bottom-0 text-center w-25">
        <h5>
            <a href="/user/{{ $reply->user->id }}">
                {{ $reply->user->name }}
            </a>
        </h5>

        <img src="https://lorempixel.com/100/100/" class="rounded-circle">

        <p>Member</p>

        <p>
            <small>
                {{ $reply->user->posts }} 
                {{ str_plural('post', $reply->user->posts) }}
            </small>
        </p>

        <p>
            <small>
                {{ $reply->user->favorites }} 
                {{ str_plural('like', $reply->user->favorites) }}
            </small>
        </p>
        
    </div>
    <div class="w-75 d-flex flex-column">
        <div class="card-body d-flex flex-column">

            <div class="pb-2">
                <span>
                    {{ $reply->created_at->diffForHumans() }}
                </span>
            </div>

            <p class="card-text">
                {{ $reply->body }}
            </p>

        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-end">
                @if(!$reply->isOwner())
                    <form method="POST" action="/forum/replies/{{ $reply->id }}/like" class="float-right">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-{{ $reply->isFavorited() ? '' : 'outline-' }}success">
                            <span class="badge badge-light">
                                {{ $reply->favorites()->count() }}
                            </span>
                            Like
                        </button>
                    </form>
                @else
                    <button type="button" class="btn btn-outline-success">
                        <span class="badge badge-light">
                            {{ $reply->favorites()->count() }}
                        </span>
                        Like
                    </button>
                @endif
            </div>
        </div>
    </div>

    </div>