<div class="card-footer border-bottom border-secondary">
    <a href="/user/{{ $reply->user->id }}">
        <span class="text-muted">{{ $reply->user->name }}</span>
    </a>
    <span class="text-muted float-right">{{ $reply->created_at->diffForHumans() }}</span>
</div>

<div class="card-body border-bottom border-secondary">
    <p class="card-text">
        {{ $reply->body }}
    </p>
</div>