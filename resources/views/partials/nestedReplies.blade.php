<ul class="nested-replies-list">
    @if (!empty($comments))
        @foreach ($replies as $nestedReply)
            <li class="nested-reply">
                <img src="{{ optional($nestedReply->user)->avatar ? asset('storage/' . $nestedReply->user->avatar) : asset('assets/images/noprofile.png') }}" alt="Profile Picture" class="profile-icon img-fluid rounded-circle">
                <span class="username">{{ optional($nestedReply->user)->username }}</span>
                <div class="comment-body">
                    {{ $nestedReply->reply_text }}
                </div>

                <!-- Recursive call for further nested replies -->
                @include('partials.nestedReplies', ['replies' => $nestedReply->replies])
            </li>
        @endforeach
    @endif
</ul>
