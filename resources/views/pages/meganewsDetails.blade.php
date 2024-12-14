@extends('main')

@section('pageLinks')
    <!-- FANCY BOX -->
    <link href="{{ asset('assets/vendor/fancybox-master/jquery.fancybox.min.css') }}" rel="stylesheet">
    <!-- FABLES CUSTOM CSS FILE -->
    <link href="{{ asset('assets/custom/css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-3">
        <span class="breadcrumbCustom"><a href="/home">HOME </a>
            <i class="fa fa-chevron-right ml-2 mr-2"></i>
            <a href="/meganews">MEGANEWS</a>
            <i class="fa fa-chevron-right ml-2 mr-2"></i>
            <span style="color:#ee2f21">{{ Str::limit($meganews->title, 20, '...') }}</span>
        </span>
    </div>

    <section class="mt-3 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    @if($meganews->meganews_images->first())
                        @if($meganews->meganews_images->first()->image[0] == 'h')
                            <img src="{{ asset($meganews->meganews_images->first()->image) }}"
                            alt="" class="imgMegaprojectsLarge">
                        @else
                            <img src="https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/{{ $meganews->meganews_images->first()->image }}"
                            alt="" class="imgMegaprojectsLarge">
                        @endif

                    @else
                    
                    @endif
                    {{-- <img src="{{ $meganews->meganews_images->first()->image }}" alt="" class="imgMegaprojectsLarge"> --}}
                </div>
                <div class="col-md-4">
                    <div class="row no-gutters">
                        @forelse ($meganews->meganews_images as $key => $meganewsImage)
                            @if ($key < 4)
                                <div class="col-md-6 col-6 pr-1">
                                    <div class="filter-img-block position-relative image-container translate-effect-right">
                                            @if($meganewsImage->image[0] == 'h')
                                                <img src="{{ $meganewsImage->image }}" alt="image"
                                                class="w-100 {{ $key == 3 ? 'imgMeganewsDetailsSmallBlur' : 'imgMeganewsDetailsSmall' }}">
                                            @else
                                                <img src="https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/{{ $meganewsImage->image }}" alt="image"
                                                class="w-100 {{ $key == 3 ? 'imgMeganewsDetailsSmallBlur' : 'imgMeganewsDetailsSmall' }}">
                                            @endif
                                        
                                        <div class="img-filter-overlay fables-main-color-transparent row m-0">
                                            <a data-fancybox="gallery" href="{{ $meganewsImage->image[0] == 'h' ? $meganewsImage->image : 'https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/'. $meganewsImage->image }}">
                                                @if ($key == 3)
                                                    <div class="h-100 d-flex justify-content-center align-items-center ">
                                                        <h5 class="text-white">{{ $meganews->meganews_images->count() }}
                                                            items&nbsp;
                                                        </h5>
                                                        <i class="fa-solid fa-ellipsis"
                                                            style="color: #fcfcfc; font-size: 20px"></i>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="filter-img-block position-relative image-container translate-effect-right">
                                    @if($meganewsImage->image[0] == 'h')
                                        <img src="{{ $meganewsImage->image }}" alt="image"
                                        class="w-100 imgMeganewsDetailsSmall" hidden>
                                    @else
                                        <img src="https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/{{ $meganewsImage->image }}" alt="image"
                                        class="w-100 imgMeganewsDetailsSmall" hidden>
                                    @endif
                                    <div class="img-filter-overlay fables-main-color-transparent row m-0">
                                        <a data-fancybox="gallery" href="{{ $meganewsImage->image[0] == 'h' ? $meganewsImage->image : 'https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/'. $meganewsImage->image }}"></a>
                                    </div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="row mt-3">
                        <span class="meganewsTitle">{{ $meganews->title }}</span>
                    </div>

                    <div class="row mt-3">
                        {!! $meganews->content !!}
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <span class="heartReactSpan"><i
                                    class=" {{ $meganews->meganewsLikes->where('user', $user['contacts']['displayName'])->count() == 1 ? 'fa-solid' : 'fa-regular' }} fa-heart heartReact"
                                    style=" {{ $meganews->meganewsLikes->where('user', $user['contacts']['displayName'])->count() == 1 ? 'color: #ee2f21' : '' }} "></i>
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
                            <form data-action="{{ route('submitCommentMeganews') }}" id="submitCommentMeganews">
                                @csrf
                                <input type="text" id="comment" required name="comment"
                                    class="form-control commentMeganewsField" placeholder="Add a comment"
                                    style="height: 40px !important;
                                border-radius: 11px;"
                                    autocomplete="off" value="">
                                <input type="hidden" name="meganews_id" id="meganews_id" value="{{ $meganews->id }}">
                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                                    <h5 class="card-title">Comments</h5>
                                    {{-- <h6 class="card-subtitle mb-2 text-muted">Total Comments (0)</h6> --}}
                                    <div id="commentMeganews">
                                        @forelse ($meganews->meganewsComments as $comment)
                                            <div class="row mt-3 commentSectionMeganewsRow" data-id="{{ $comment->id }}">
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
                                                            <button class="btn btn-info btn-sm updateMeganewsCommentButton"
                                                                data-toggle="modal" data-target="#updateMeganewsComment"
                                                                data-id="{{ $comment->id }}"
                                                                data-comment="{{ $comment->comment }}">Update</button>
                                                            <button
                                                                class="btn btn-primary btn-sm deleteCommentMeganewsButton"
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
                <div class="col-md-4">
                    <div class="row mt-3">
                        <h3 class="font-weight-bold">{{ date('F', mktime(0, 0, 0, $meganews->month, 1)) }}
                            {{ $meganews->year }}</h3>
                        <hr class="hrTitle">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="updateMeganewsComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('updateMeganewsComment') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="modal-body">
                            <textarea style="height: 200px !important;" name="comment" class="form-control" id="commentMeganewsTextbox"
                                cols="50" rows="50"></textarea>
                            <input type="hidden" id="meganews_comment_id" name="meganews_comment_id">
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
    <script src="{{ asset('js/meganews.js') }}"></script>
    <script src="{{ asset('assets/vendor/fancybox-master/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
@endsection
