<div class="row no-gutters commentSectionRow" data-id="{{ $comment->id }}">
    <div class="col-2 text-center pr-2">
        <span class="initialCommentator"> {{ $comment->user[0] }}
        </span>
    </div>
    <div class="col-10">
        <span class="nameCommentator">{{ $comment->user }} <span
                class="timeComment">{{ $comment->created_at->diffForHumans() }}</span></span>
        <br>
        <div class="commentColor">
            <span class="commentBanner">
                @if ($comment->bannerQuestionImages->image != '')
                    <img src="{{ $comment->bannerQuestionImages->image }}" alt=""
                        class="bannerQuestionImageStyle">
                    <br>
                    <br>
                @endif
                {!! $comment->comment !!}
                <div
                    class="row {{ $comment->user == $user['displayName'] ? 'actionButtonHidden' : 'actionButtonHiddenPermanent' }}">
                    <div class="col-6 text-center">
                        <span class="text-center ">
                            <a type="button" data-id="{{ $comment->id }}" data-comment="{{ trim($comment->comment) }}"
                                class="editBannerCommentButton">Edit</a>
                        </span>
                    </div>
                    <div class="col-6 text-center">
                        <span class="text-center">
                            <a type="button" class="deleteCommentBanner" data-id="{{ $comment->id }}">Delete</a>
                        </span>
                    </div>
                </div>
            </span>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <i class=" heartReact{{ $comment->id }}
                    {{ $comment->bannerQuestionLikes->where('user', $user['displayName'])->count() >= 1 ? 'fa-solid' : 'fa-regular' }}
                     fa-heart heartReact"
                    style="{{ $comment->bannerQuestionLikes->where('user', $user['displayName'])->count() >= 1 ? 'color: #ee2f21' : '' }}"
                    data-id="{{ $comment->id }}"></i>
                <a type="button" class="likeList" data-record="{{ json_encode($comment->bannerQuestionLikes) }}">
                    <i style="font-size: 12px"
                        id="countReact{{ $comment->id }}">{{ $comment->bannerQuestionLikes->count() }}
                    </i>
                    <i
                        style="font-size: 12px">{{ $comment->bannerQuestionLikes->count() > 1 ? ($comment->bannerQuestionLikes->count() == 0 ? '' : 'Likes') : 'Like' }}</i>
                </a>
            </div>
            {{-- <div class="col-1">
                <i class="fa-regular fa-comment"></i>
            </div> --}}
        </div>
    </div>
</div>
