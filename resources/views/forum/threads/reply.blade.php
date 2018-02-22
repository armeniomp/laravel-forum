<div class="d-flex flex-row border-bottom border-secondary">
                
        <div class="card-header text-center w-25">
            <h5>
                <a href="/user/{{ $reply->user->id }}">
                    {{ $reply->user->name }}
                </a>
            </h5>

            <img src="https://lorempixel.com/100/100/" class="rounded-circle">
            <p>Member</p>
            <small>{{ $reply->user->replies_count + $reply->user->threads_count }} {{ str_plural('post', $reply->user->replies_count + $reply->user->threads_count) }}</small>
            
        </div>

        <div class="d-flex flex-column w-75">

            <div class="card-body">
                <p class="card-text">
                    {{ $reply->body }}
                </p>
            </div>
            
            <div class="card-footer">
                <span class="float-right">
                    {{ $reply->created_at->diffForHumans() }}
                </span>
            </div>
        </div>

    </div>