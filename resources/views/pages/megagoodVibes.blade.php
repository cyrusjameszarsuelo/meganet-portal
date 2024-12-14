@extends('main')


@section('pageLinks')
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/megagoodVibes.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/animate.css-master/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="banner">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <span class="bannerTitle"><span style="color:#ee2f21">MEGA</span>GOOD VIBES</span>
            </div>
        </div>
        <hr class="hrCustom mt-4 mb-2">
        <span class="breadcrumbCustom"><a href="/home">HOME</a> <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
                style="color:#ee2f21">MEGAGOOD
                VIBES</span>
        </span>
    </div>

    <section class="container mt-3 mb-3">
        <div class="content">
            <div class="row">
                <div class="col-md-8 col-12">
                    <video poster="{{ $megagoodVibes->thumbnail[0] == 'h' ? $megagoodVibes->thumbnail : 'https://meganet-portal-admin.atwebpages.com/uploads/MegaGoodVibes-Thumbnail/' . $megagoodVibes->thumbnail }}" controls
                        style="width: 100%; height: 500px; background-color: rgb(0, 0, 0) !important;">
                        <source src="{{ $megagoodVibes->file[0] == 'h' ? $megagoodVibes->file : 'https://meganet-portal-admin.atwebpages.com/uploads/MegaGoodVibes-Videos/' . $megagoodVibes->file }}" type="video/mp4">
                    </video>

                    <div class="row">
                        <div class="col-md-12">
                            {!! $megagoodVibes->content !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <span class="heartReactSpan"><i
                                    class=" {{ $megagoodVibes->megagoodVibeLikes->where('user', $user['contacts']['displayName'])->count() == 1 ? 'fa-solid' : 'fa-regular' }} fa-heart heartReact"
                                    style=" {{ $megagoodVibes->megagoodVibeLikes->where('user', $user['contacts']['displayName'])->count() == 1 ? 'color: #ee2f21' : '' }} "></i>
                                &nbsp; Like</span>
                        </div>
                        <div class="col-md-2">
                            <span><i class="fa-regular fa-comment"></i> &nbsp; Comment</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-1">
                            <span class="initialCommentator"> {{ $user['contacts']['displayName'][0] }}
                            </span>
                        </div>
                        <div class="col-md-11">
                            <form data-action="{{ route('submitCommentMegagoodVibes') }}" id="submitCommentMegagoodVibes">
                                @csrf
                                <input type="text" id="comment" required name="comment" class="form-control "
                                    placeholder="Add a comment"
                                    style="height: 40px !important;
                                border-radius: 11px;"
                                    autocomplete="off" value="">
                                <input type="hidden" name="megagood_vibe_id" id="megagood_vibe_id"
                                    value="{{ $megagoodVibes->id }}">
                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                                    <h5 class="card-title">Comments</h5>
                                    {{-- <h6 class="card-subtitle mb-2 text-muted">Total Comments (0)</h6> --}}
                                    <div id="commentMegagoodVibes">
                                        @forelse ($megagoodVibes->megagoodVibeComments as $comment)
                                            <div class="row mt-3 commentSectionMegagoodVibesRow"
                                                data-id="{{ $comment->id }}">
                                                <div class="col-md-1">
                                                    <span class="initialCommentator"> {{ $comment->user[0] }}
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    <span class="nameCommentator">{{ $comment->user }} <span
                                                            class="timeComment">{{ $comment->created_at->diffForHumans() }}</span></span>
                                                    <br>
                                                    <div class="commentColor">
                                                        <span class="commentBanner"
                                                            style="font-size: 15px; line-height: 26px; font-family: Helvetica">{{ $comment->comment }}</span>
                                                    </div>
                                                    @if ($comment->user == $user['contacts']['displayName'])
                                                        <div class="btn-group float-right mt-2">
                                                            <button
                                                                class="btn btn-info btn-sm updateMegagoodVibesCommentButton"
                                                                data-toggle="modal"
                                                                data-target="#updateMegagoodVibesComment"
                                                                data-id="{{ $comment->id }}"
                                                                data-comment="{{ $comment->comment }}">Update</button>
                                                            <button
                                                                class="btn btn-primary btn-sm deleteCommentMegagoodVibesButton"
                                                                data-id="{{ $comment->id }}">Delete</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-12">
                    <div class="row">
                        <span class="extraTitleMeganet">More Good Vibes!</span>
                    </div>
                    <div class="row">
                        <hr class="megawideHr">
                    </div>
                    @forelse ($megagoodVibesAll as $item)
                        @if ($item->id != $megagoodVibes->id)
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <img class="megagoodVibesImages" src="{{ $item->thumbnail[0] == 'h' ? $item->thumbnail : 'https://meganet-portal-admin.atwebpages.com/uploads/MegaGoodVibes-Thumbnail/' . $item->thumbnail }}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <span>
                                        <i class="fa-regular fa-clock"></i>
                                        <span style="font-size: 13px;"
                                            class="ml-2">{{ $item->created_at->diffForHumans() }}</span>
                                    </span>
                                    <br>
                                    <a href="/megagood-vibes/{{ $item->id }}">
                                        <span style="font-size: 15px; font-size: Helvetica; font-weight: bold;">
                                            {!! strip_tags(Str::words($item->content, 90, '...')) !!}
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <hr style="opacity: 1">
                        @endif
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="updateMegagoodVibesComment" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('updateMegagoodVibesComment') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="modal-body">
                            <textarea style="height: 200px !important;" name="comment" class="form-control" id="commentMegagoodVibesTextbox"
                                cols="50" rows="50"></textarea>
                            <input type="hidden" id="megagoodVibes_comment_id" name="megagoodVibes_comment_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="{{ asset('js/megagoodVibe.js') }}"></script>
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
@endsection
