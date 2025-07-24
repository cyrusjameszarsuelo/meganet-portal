@extends('main')

@section('pageLinks')
    @include('includes.homepage-css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/css/emoji.css" rel="stylesheet">
    <style>
        .clickable-row {
            background-color: white;
            padding: 1px 10px;
            display: block;
        }

        .clickable-row:hover {
            background-color: #d5d5d5;
        }

        .tableNames {
            width: 100%;
            padding-left: 0px;
        }

        #divNames {
            margin-top: -50px;
            z-index: auto;
            position: relative;
            overflow: auto;
            height: 200px;
            display: none;
        }

        .emoji-wysiwyg-editor {
            background: #fff !important;
            color: #000 !important;
            font-size: 14px;
            box-shadow: none !important;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 11px;
            height: 60px !important;
        }



        .modal .sigla {
            background-color: transparent;
            border: none;
            border-radius: 7px;
        }

        .modal .sigla .modal-body {
            border-radius: 7px;
            overflow: hidden;
            background-color: #efefef;
            padding-left: 0px;
            padding-right: 0px;
            height: 400px;
            -webkit-box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
            box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
        }

        /* .modal .sigla .modal-body h2 {
                font-size: 18px;
            }

            .modal .sigla .modal-body p {
                color: #777;
                font-size: 16px;
            }

            .modal .sigla .modal-body h3 {
                color: #000;
                font-size: 33px;
                font-family: Magistral-Bold;
            }

            .modal .sigla .modal-body .close-btn {
                color: #000;
            }

            .modal .sigla .modal-body .promo-img {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
            }

            .modal .sigla .modal-body .promo-img .price {
                top: 20px;
                left: 20px;
                position: absolute;
                color: #fff;
            } */


        .custom-select {
            border: none;
            -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
        }

        .custom-select:active,
        .custom-select:focus,
        .custom-select:hover {
            -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
        }

        .bg-image {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .logo img {
            width: 70px;
        }

        .line {
            position: relative;
            padding-bottom: 20px;
        }

        .line:after {
            left: 50%;
            bottom: 0;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            position: absolute;
            content: "";
            width: 70px;
            height: 1px;
            background: #ccc;
        }

        .custom-note {
            color: #999;
        }

        .custom-note a {
            color: #555;
            font-weight: 900 !important;
        }

        #closeModal {
            position: absolute;
            color: white;
            top: 0px;
            right: 11px;
            background-color: transparent;
        }

        .bannerVideo {
            position: relative;
            overflow: hidden;
        }

        .bannerVideo video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
        }
    </style>
@endsection

@section('content')
    <div class="content  mt-3 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="h-100 d-flex justify-content-center align-items-center">
                    <span class="titleMeganet">Welcome, <span style="color: #ee2f21">KaMegawide!</span></span>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <hr class="megawideHr">
                </div>
            </div>
        </div>
    </div>

    <section class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="bannerVideo" style="position: relative; height: 500px; overflow: hidden;">
                    <video autoplay muted loop style="position: absolute; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                        <source src="{{ asset('uploads/Banner/' . $bannerQuestion->image) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="row" style="position: relative; z-index: 2; height: 500px; background: linear-gradient(0deg, rgb(18 18 18) 0%, rgba(255,255,255,0) 30%);">
                        <div class="col-md-6 col-6">
                            <div class="row">
                                <div class="col-md-5 col-1"></div>
                                <div class="col-md-7 col-11 d-flex align-items-start flex-column" style="height: 500px;">
                                    {{-- <span class="mt-auto titleBanner"> <span
                                            class="vl mr-2"></span>{{ $bannerQuestion->title }}</span>
                                    <span class="pb-4 pl-2 questionBanner">{{ $bannerQuestion->question }}</span> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-4 ml-5">
                            <div class="row">
                                <div class="col-11">
                                    <div class="bgQbanner align-items-start flex-column p-2">
                                        <span class="commentTitleBanner">Comments</span>
                                        <div class="loader " hidden></div>
                                        <div class="groupComments">
                                            @forelse ($bannerQuestion->bannerQuestionComments as $key => $comment)
                                                @if ($key <= 10)
                                                    @include('assets.bannerComments') @if ($key == 10)
                                                        <a type="button" style="color:#ee2f21"
                                                            id="viewAllCommentsButton">See
                                                            More..</a>
                                                    @endif
                                                @endif
                                            @empty
                                            @endforelse

                                        </div>
                                        <form data-action="{{ route('submitBannerComment') }}" id="submitCommentBanner"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row no-gutters">
                                                <div class="col-2 text-center">
                                                    <span class="initialCommentator">
                                                        {{ $user['displayName'][0] }}
                                                    </span>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="emoji-picker-container form-control"
                                                        data-emojiable="true" placeholder="Add a comment"
                                                        style="height: 60px !important;
                                                border-radius: 11px;"
                                                        required name="comment" autocomplete="off" id="comment">

                                                    <input type="hidden" name="banner_question_id" id="banner_question_id"
                                                        value="{{ $bannerQuestion->id }}">
                                                    <button class="btn btn-primary btn-sm btn-block mt-3"><i
                                                            class="fa-regular fa-paper-plane"></i> Add Comment </button>

                                                    <div id="divNames">
                                                        <ul class="tableNames">
                                                            @foreach ($userList as $users)
                                                                <li class='clickable-row' data-name="{{ $users->name }}">
                                                                    <p>{{ $users->name }}</p>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-1 pl-2">
                                                    <label for="fileUpload"><i
                                                            class="fa-regular fa-image fa-lg"></i></label>
                                                    <input type="file" id="fileUpload" hidden name="bannerImage">
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-3 mb-3">
        <div class="row">
            <div class="h-100 d-flex justify-content-center align-items-center mt-3">
                <span class="extraTitleMeganet">Explore more <span style="color: #ee2f21">content!</span></span>
            </div>

            <main class="page-content">
                <div class="card">
                    <div class="card-content h-50 d-flex justify-content-center align-items-center ">
                        <h2 class="title">
                            {{-- <a href="/meganews" style="color: white;">MEGANEWS</a> --}}
                            <a href="#" class="metricStore" data-action="Meganews" data-url="/meganews" data-value=""
                                style="color: white;">MEGANEWS</a>
                        </h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content h-50 d-flex justify-content-center align-items-center ">
                        <h2 class="title"><a href="/megagood-vibes/{{ $megagoodVibes->id }}" style="color: white;">MEGAGOOD
                                VIBES</a></h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content h-50 d-flex justify-content-center align-items-center ">
                        <h2 class="title">
                            {{-- <a href="/megatrivia" style="color: white;">MEGATRIVIA</a> --}}
                            <a href="#" class="metricStore" data-action="Megatrivia" data-url="/megatrivia"
                                data-value="" style="color: white;">MEGATRIVIA</a>
                        </h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content h-50 d-flex justify-content-center align-items-center ">
                        <h2 class="title"><a href="/megaprojects/{{ $megaprojects->id }}"
                                style="color: white;">MEGAPROJECTS</a></h2>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="viewAllComments" tabindex="-1" role="dialog" aria-labelledby="viewAllCommentsLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAllCommentsLabel">All Comments</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                <div class="modal-body">
                    <div class="content">
                        @forelse ($bannerQuestion->bannerQuestionComments as $key => $comment)
                            @include('assets.bannerComments')
                        @empty
                        @endforelse

                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Comment</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                <form action="{{ route('updateBannerComment') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <textarea style="height: 200px !important;" name="comment" class="form-control" id="commentBanner" cols="50"
                            rows="50"></textarea>
                        <input type="hidden" id="banner_question_id" name="banner_question_id">
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="likeListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Likes</h5>
                    <button type="button" id="closeLikeListModal" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="likeListContent">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content sigla rounded-0" style="align-items: center;">
                <div class="modal-body py-0">



                    {{-- <div class="d-flex main-content">
                        <div class="bg-image promo-img mr-3"
                            style="background-image: url('https://images.pexels.com/photos/2098578/pexels-photo-2098578.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); height: 400px;">
                        </div>
                        <div class="content-text p-3 px-5 align-item-stretch" style="margin: auto;">
                            <div class="text-center">
                                <h3 class="mb-3 line">
                                    <sigla style="color: #ee2f21">SIGLA</sigla> Awards
                                </h3>

                                <p class="mb-5">Click the button below to nominate a colleague whom you have seen exhibit
                                    Megawide values.</p>

                                <a class="btn btn-primary" href="{{ url('/nomination') }}">Nominate Now!</a>
                            </div>
                        </div>
                    </div> --}}
                    <a type="button" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <a href="{{ url('/nomination-mechanics') }}">
                        <img src="{{ asset('https://meganet-admin.portalwebsite.net/uploads/sigla-awards-image/' . $award->image) }}"
                            alt="{{ $award->title }}" width="100%" height="100%">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="{{ asset('js/meganet.js') }}"></script>
    <script src="{{ asset('lib/js/config.min.js') }}"></script>
    <script src="{{ asset('lib/js/util.min.js') }}"></script>
    <script src="{{ asset('lib/js/jquery.emojiarea.min.js') }}"></script>
    <script src="{{ asset('lib/js/emoji-picker.min.js') }}"></script>

    <script>
        $(function() {
            window.emojiPicker = new EmojiPicker({
                emojiable_selector: '[data-emojiable=true]',
                assetsPath: '/lib/img/',
                popupButtonClasses: 'fa fa-smile-o' // far fa-smile if you're using FontAwesome 5
            });
            window.emojiPicker.discover();
        });
    </script>

    <script>
        $(document).ready(function() {
            var value = [];
            var storeNewVal = '';
            $(".emoji-wysiwyg-editor").on("keyup", function(e) {
                var keynum = e.keyCode;
                // if (keynum && e.shiftKey && keynum === 50) {
                //     $('#divNames').css('display', 'block');

                //     $("#divNames li").filter(function() {
                //         if($(this).attr('data-name').toLowerCase().indexOf(value) > -1) {
                //             $(this).css('display', 'block');
                //         } else {
                //             $(this).css('display', 'none');
                //         }
                //     });
                // }

                if ($(this).text().indexOf("@") != -1) {
                    // var value = $(this).text().toLowerCase();
                    // console.log();
                    $('#divNames').css('display', 'block');
                    if (keynum === 8) {
                        value.pop();
                    }

                    if (keynum !== 50 && keynum !== 16 && keynum !== 8 && keynum !== 40 && keynum !== 38) {
                        value.push(String.fromCharCode(e.which));
                        var newVal = value.join("");
                        storeNewVal = newVal;

                        $("#divNames li").filter(function() {
                            if ($(this).attr('data-name').toUpperCase().indexOf(newVal) > -1) {
                                $(this).css('display', 'block');
                            } else {
                                $(this).css('display', 'none');
                            }
                        });
                    }


                } else {
                    value = [];
                    $('#divNames').css('display', 'none');
                }


            });


            $(".clickable-row").click(function() {
                var text = $('.emoji-wysiwyg-editor').text();
                console.log(storeNewVal);
                // modify text
                text = text.replace(storeNewVal.toLowerCase(), '').replace('@', '');
                // update element text
                $('.emoji-wysiwyg-editor').text(text);
                $('.emoji-wysiwyg-editor').append($(this).closest('li').find('p').text());
                $('#divNames').css('display', 'none');
            });
        });

        $('#closeModal').click(function() {
            $('#exampleModalCenter').modal('hide')
        });

        $.ajax({
            url: "/getValidEmployees",
            type: "GET",
            success: function(data) {
                let user = $('div.userInfo span b').html().toUpperCase();
                data.forEach(element => {
                    // console.log(element.name);
                    if (element.name.indexOf(user) >= 0) {
                        $('#exampleModalCenter').modal('show')
                    }
                });
            },
            error: function(e) {
                console.log(e);
            }
        })
    </script>
@endsection
