@extends('main')

@section('pageLinks')
    @include('includes.homepage-css')
    <link rel="stylesheet" href="{{ asset('css/star-modal.css') }}">
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

            .emoji-wysiwyg-editor {
                background: #fff !important;
                color: #000 !important;
                font-size: 14px;
                box-shadow: none !important;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 11px;
                height: 60px !important;
            }
        }

        .modal.show .star-grid .star-card:nth-child(1) {
            animation: starFadeScale 0.55s ease-out 0.18s both;
        }

        .modal.show .star-grid .star-card:nth-child(2) {
            animation: starFadeScale 0.55s ease-out 0.24s both;
        }

        .modal.show .star-grid .star-card:nth-child(3) {
            animation: starFadeScale 0.55s ease-out 0.30s both;
        }

        .modal.show .star-grid .star-card:nth-child(4) {
            animation: starFadeScale 0.55s ease-out 0.36s both;
        }

        @keyframes floatBlob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(-12px, 10px) scale(1.06);
            }
        }

        @keyframes floatRing {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(10px, -6px) rotate(4deg);
            }
        }

        @keyframes scribbleDrift {
            0% {
                transform: translate(0, 0) rotate(-8deg);
            }

            100% {
                transform: translate(18px, -6px) rotate(-2deg);
            }
        }

        @keyframes floatSquare {
            0% {
                transform: translate(0, 0) rotate(-3deg);
            }

            100% {
                transform: translate(6px, 8px) rotate(3deg);
            }
        }

        @keyframes floatUnderline {
            0% {
                transform: translate(0, 0) rotate(6deg);
            }

            100% {
                transform: translate(-8px, -4px) rotate(0deg);
            }
        }

        @keyframes starFadeUp {
            0% {
                opacity: 0;
                transform: translateY(12px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes starFadeScale {
            0% {
                opacity: 0;
                transform: translateY(8px) scale(0.98);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .star-primary-btn {
            background-color: #ee2f21;
            border-color: #ee2f21;
            border-radius: 999px;
            padding: 9px 20px;
            font-size: 14px;
            animation: starCallToActionPulse 2.8s ease-out infinite;
        }

        .star-link {
            font-size: 13px;
            color: #5c2a7a;
            text-decoration: underline;
        }

        .star-link:hover {
            color: #ee2f21;
        }

        .star-admin-btn {
            background-color: transparent;
            border-color: #ee2f21;
            color: #ee2f21;
            border-radius: 999px;
            padding: 9px 20px;
            font-size: 14px;
            margin-right: 6px;
        }

        .star-admin-btn:hover {
            background-color: #ee2f21;
            color: #fff;
        }

        .star-prizes-block {
            background-color: #fff7f6;
            border-radius: 12px;
            padding: 10px 12px;
            margin-top: 10px;
            border: 1px dashed #ffd6cf;
        }

        .star-prizes-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        .star-prizes-rules {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
        }

        .star-prizes-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 8px;
            justify-content: space-between;
        }

        .star-prize-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-size: 13px;
            color: #444;
            flex: 0 0 calc(50% - 6px);
            cursor: pointer;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 6px 4px;
        }

        .star-prize-img {
            width: 52px;
            height: 52px;
            border-radius: 6px;
            object-fit: cover;
            margin-bottom: 4px;
            transition: transform 0.22s ease-out, box-shadow 0.22s ease-out;
        }

        .star-prize-label strong {
            font-weight: 700;
        }

        .star-prize-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .star-prize-item:hover .star-prize-img {
            transform: scale(1.12);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.18);
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

        /* STAR modal readability tweaks */

        .star-modal-wrapper {
            font-size: 15px;
        }

        .star-title-main {
            font-size: 22px;
        }

        .star-tagline span {
            font-size: 14px;
        }

        .star-card {
            display: flex;
            flex-direction: column;
            /* background: linear-gradient(135deg, #f8fafd 0%, #fdf6f8 100%); */
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(44, 44, 44, 0.10);
            padding: 22px 22px 14px 22px;
            margin-bottom: 22px;
            border-left: 7px solid #3a8dde;
            border-right: none;
            border-top: none;
            border-bottom: none;
            position: relative;
            transition: box-shadow 0.2s, border-color 0.2s;
        }
        .star-card[data-section="ar"] {
            border-left-color: #ffd700;
        }
        .star-card:hover, .star-card:focus-within {
            box-shadow: 0 8px 28px rgba(44, 44, 44, 0.16);
            border-left-width: 10px;
        }
        .star-badge {
            font-size: 28px;
            font-weight: 700;
            background: #fff;
            color: #3a8dde;
            border-radius: 20px;
            width: 88px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(58, 141, 222, 0.13);
            margin-right: 22px;
            border: 2.5px solid #e3eaf6;
            letter-spacing: 1.5px;
        }
        .star-card[data-section="ar"] .star-badge {
            color: #ffd700;
            border-color: #fff5cc;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.10);
        }
        .star-card-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .star-card small.text-muted {
            font-size: 14px;
        }
        .star-card textarea {
            background: #f6fafd;
            border: 1.5px solid #e3eaf6;
            border-radius: 10px;
            font-size: 16px;
            padding: 14px 14px 14px 14px;
            margin-top: 10px;
            margin-bottom: 6px;
            min-height: 80px;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 3px rgba(44, 44, 44, 0.04);
        }
        .star-card textarea:focus {
            border-color: #3a8dde;
            box-shadow: 0 2px 8px rgba(58, 141, 222, 0.10);
            background: #f0f7fd;
        }
        .star-card[data-section="ar"] textarea:focus {
            border-color: #ffd700;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.10);
            background: #fffbe6;
        }
        .star-values-block {
            margin-top: 6px;
            padding: 16px 18px 18px;
            border-radius: 18px;
            background: linear-gradient(135deg, #ffffff 0%, #fff8f6 100%);
            box-shadow: 0 4px 18px rgba(44, 44, 44, 0.08);
            border: 1px solid #f1e8e6;
        }

        .star-values-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
        }

        .star-values-subtitle {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .star-values-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .star-value-option {
            flex: 1 1 calc(33.333% - 10px);
            min-width: 120px;
            border: 1.5px solid #e6dede;
            background: #fff;
            color: #444;
            border-radius: 14px;
            padding: 12px 10px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            transition: all 0.18s ease;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .star-value-option:hover,
        .star-value-option:focus {
            border-color: #ee2f21;
            color: #ee2f21;
            transform: translateY(-1px);
            outline: none;
        }

        .star-value-option.active {
            border-color: #ee2f21;
            background: linear-gradient(135deg, #ee2f21 0%, #ff6b5f 100%);
            color: #fff;
            box-shadow: 0 8px 18px rgba(238, 47, 33, 0.18);
        }

        .star-value-option.active::after {
            content: "\f00c";
            font-family: "FontAwesome";
            margin-left: 8px;
            font-size: 11px;
        }
        .star-char-count {
            font-size: 12px;
        }

        .star-progress-label {
            font-size: 13px;
        }

        /* STAR modal encouragement / interaction */
        .star-encourage-banner {
            margin-top: 6px;
            margin-bottom: 8px;
            padding: 8px 10px;
            border-radius: 10px;
            background: linear-gradient(135deg, #fff5f4 0%, #fff7ff 100%);
            display: flex;
            align-items: center;
            animation: starEncourageFloat 4s ease-in-out infinite alternate;
        }

        .star-encourage-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            border-radius: 999px;
            background-color: #ee2f21;
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            margin-right: 8px;
            box-shadow: 0 3px 8px rgba(238, 47, 33, 0.45);
        }

        .star-encourage-text {
            font-size: 12px;
            color: #444;
        }

        @keyframes starEncourageFloat {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-3px);
            }
        }

        @keyframes starCallToActionPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(238, 47, 33, 0.5);
                transform: translateY(0);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(238, 47, 33, 0);
                transform: translateY(-1px);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(238, 47, 33, 0);
                transform: translateY(0);
            }
        }

        .star-prizes-highlight {
            animation: starPrizesGlow 1.8s ease-in-out 1;
        }

        @keyframes starPrizesGlow {
            0% {
                box-shadow: 0 0 0 0 rgba(238, 47, 33, 0);
                transform: scale(1);
            }

            40% {
                box-shadow: 0 0 0 10px rgba(238, 47, 33, 0.12);
                transform: scale(1.02);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(238, 47, 33, 0);
                transform: scale(1);
            }
        }

        #closeModal {
            position: absolute;
            color: #555;
            top: 8px;
            right: 14px;
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            font-size: 18px;
            line-height: 1;
            cursor: pointer;
            z-index: 3;
            width: 28px;
            height: 28px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
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
                    <video id="bannerVideo" autoplay muted
                        style="position: absolute; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                        <source src="{{ asset('uploads/Banner/20251024062225.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="row" style="position: relative; z-index: 2; height: 500px; ">
                        {{-- background: linear-gradient(0deg, rgb(18 18 18) 0%, rgba(255,255,255,0) 0%); --}}
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
            <div class="modal-content sigla rounded-0">
                <div class="modal-body">
                    <div class="star-modal-wrapper">
                        <!-- Confetti Canvas Overlay -->
                        <canvas id="starConfettiCanvas"
                            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;pointer-events:none;"></canvas>
                        <button type="button" id="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <span class="star-doodle star-doodle-1"></span>
                        <span class="star-doodle star-doodle-2"></span>
                        <span class="star-doodle star-doodle-3"></span>
                        <span class="star-doodle star-doodle-4"></span>
                        <span class="star-doodle star-doodle-5"></span>
                        <span class="star-doodle star-doodle-6">star method</span>

                        <img src="{{ asset('images/star-images/line.png') }}" alt="" class="star-header-line">
                        <div class="d-flex justify-content-between align-items-start mb-2 star-header-row">
                            <div>
                                <div class="star-dear-row">
                                    <span>Dear&nbsp;</span>
                                    <input type="text" id="starTo" name="to_name" placeholder="Teammate's name"
                                        required>
                                </div>
                                <div class="star-thank-row mt-1">
                                    <span class="star-eyebrow">Thank you for</span>
                                    <input type="text" id="starThanksFor" name="thanks_for"
                                        placeholder="What are you thanking them for?" class="star-thank-input" required>
                                </div>
                                <div class="star-title-main mt-1">You're the reason "we" did it.</div>
                                <div class="star-tagline mt-1 d-flex align-items-center">
                                    <span class="star-pill-icon"><i class="fa fa-star"></i></span>
                                    <span>Capture a quick STAR story to brighten someone’s day.</span>
                                </div>
                            </div>
                            <div class="star-hearts">
                                <span></span><span></span><span></span><span></span>
                            </div>
                        </div>

                        <div class="star-encourage-banner">
                            <div class="star-encourage-chip"><i class="fa fa-heart mr-1"></i>Quick appreciation</div>
                            <div class="star-encourage-text">It only takes a minute to send a STAR and make someone’s day
                                brighter.</div>
                        </div>

                        <div class="star-values-block">
                            <div class="star-values-title">Which Megawide value(s) did this person demonstrate?</div>
                            <div class="star-values-subtitle">Select one or more values that best describe the behavior you are recognizing.</div>
                            <div class="star-values-grid" id="starValuesGrid">
                                <button type="button" class="star-value-option" data-value="Community">Community</button>
                                <button type="button" class="star-value-option" data-value="Malasakit">Malasakit</button>
                                <button type="button" class="star-value-option" data-value="Excellence">Excellence</button>
                                <button type="button" class="star-value-option" data-value="Teamwork">Teamwork</button>
                                <button type="button" class="star-value-option" data-value="Innovation">Innovation</button>
                                <button type="button" class="star-value-option" data-value="Integrity">Integrity</button>
                            </div>
                        </div>

                        <form id="starAppreciationForm">
                            <div class="star-grid">
                                <div class="star-card" data-section="st">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="star-badge">ST</div>
                                        <div>
                                            <div class="star-card-title">Situation &amp; Task</div>
                                        </div>
                                    </div>
                                    <textarea id="starST" name="situation_task" maxlength="560" required style="min-height: 160px; font-size: 20px;"></textarea>
                                    <!-- After ST GIF -->
                                    <div class="d-flex justify-content-center my-2">
                                        <img src="{{ asset('images/star-images/4th.gif') }}" alt="Celebration"
                                            style="height: 60px;">
                                    </div>
                                    <div class="star-char-count" data-for="starST">0 / 560</div>
                                </div>

                                <div class="star-card" data-section="ar">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="star-badge">AR</div>
                                        <div>
                                            <div class="star-card-title">Action &amp; Results</div>
                                        </div>
                                    </div>
                                    <textarea id="starAR" name="action_results" maxlength="560" required style="min-height: 160px; font-size: 20px;"></textarea>
                                    <!-- After AR GIF -->
                                    <div class="d-flex justify-content-center my-2">
                                        <img src="{{ asset('images/star-images/2nd.gif') }}" alt="Stars"
                                            style="height: 60px;">
                                    </div>
                                    <div class="star-char-count" data-for="starAR">0 / 560</div>
                                </div>
                            </div>

                            {{-- <div class="mt-3 star-prizes-block">
                                <div class="star-prizes-title">Earn Stars and exchange them for these amazing items by end
                                    of the year:</div>
                                <div class="star-prizes-rules">5 stars when you receive a commendation &bull; 2 stars when
                                    you send a commendation</div>
                                <div class="star-prizes-list">
                                    <div class="star-prize-item">
                                        <img src="{{ asset('images/prizes/ipad.jpg') }}" alt="iPad"
                                            class="star-prize-img">
                                        <span class="star-prize-label">iPad &ndash; <strong>2,000 pts</strong></span>
                                    </div>
                                    <div class="star-prize-item">
                                        <img src="{{ asset('images/prizes/iwatch.jpeg') }}" alt="iWatch"
                                            class="star-prize-img">
                                        <span class="star-prize-label">iWatch &ndash; <strong>1,500 pts</strong></span>
                                    </div>
                                    <div class="star-prize-item">
                                        <img src="{{ asset('images/prizes/airpods.jpeg') }}" alt="AirPods"
                                            class="star-prize-img">
                                        <span class="star-prize-label">AirPods &ndash; <strong>500 pts</strong></span>
                                    </div>
                                    <div class="star-prize-item">
                                        <img src="{{ asset('images/prizes/powerbank.jpg') }}" alt="Power bank"
                                            class="star-prize-img">
                                        <span class="star-prize-label">Power banks &ndash; <strong>300 pts</strong></span>
                                    </div>
                                    <div class="star-prize-item">
                                        <img src="{{ asset('images/prizes/starbucks gc.jpg') }}" alt="Starbucks GC"
                                            class="star-prize-img">
                                        <span class="star-prize-label">Starbucks GC &ndash; <strong>100 pts</strong></span>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="mt-3">
                                <div class="star-progress">
                                    <div class="star-progress-bar" id="starProgressBar"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <div class="star-progress-label" id="starProgressLabel">
                                        Start your STAR story.
                                    </div>
                                    <div class="star-from">
                                        <span>From&nbsp;</span>
                                        <input type="text" id="starFrom" name="from_name" placeholder="Your name"
                                            value="{{ $user['displayName'] ?? '' }}" disabled>
                                    </div>
                                </div>
                            </div>

                            @php
                                $starAdminEmails = config('star.admins', []);
                                $currentEmail = strtolower($user['mail'] ?? ($user['userPrincipalName'] ?? ''));
                                $isStarAdmin = in_array($currentEmail, array_map('strtolower', $starAdminEmails));
                            @endphp

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="star-footer-note">
                                    In small triumphs and joys, let our spirits sing. Together we rise, in lifting others,
                                    we brave any weather.
                                </small>
                                <div class="d-flex align-items-center">
                                    @if ($isStarAdmin)
                                        <a href="{{ route('star.entries') }}" class="btn btn-sm star-admin-btn">
                                            View STAR entries
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-primary star-primary-btn"
                                        id="starDraftButton">
                                        Save STAR draft
                                    </button>
                                </div>
                            </div>
                            <img src="{{ asset('images/star-images/flower.png') }}" alt=""
                                class="star-footer-flower">
                        </form>
                    </div>
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
        const starStoreUrl = "{{ route('star.store') }}";

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

            // STAR modal interactions
            if ($('#starAppreciationForm').length) {
                function updateStarCharCount(id) {
                    var $field = $('#' + id);
                    if (!$field.length) return;
                    var max = parseInt($field.attr('maxlength')) || 0;
                    var len = $field.val().length;
                    var $counter = $('[data-for="' + id + '"]');
                    if ($counter.length) {
                        $counter.text(len + (max ? ' / ' + max : ''));
                    }
                }

                function getSelectedStarValues() {
                    return $('.star-value-option.active').map(function() {
                        return $(this).data('value');
                    }).get();
                }

                window.launchStarConfetti = function() {
                    var canvas = document.getElementById('starConfettiCanvas');
                    if (!canvas) return;
                    var ctx = canvas.getContext('2d');
                    var W = window.innerWidth,
                        H = window.innerHeight;
                    canvas.width = W;
                    canvas.height = H;
                    canvas.style.display = 'block';
                    var colors = ['#ee2f21', '#ffd700', '#5c2a7a', '#ff7f50', '#00bcd4', '#fff'];
                    var shapes = ['rect', 'triangle'];
                    var confettiCount = Math.floor(W / 10);
                    var confetti = [];
                    for (var i = 0; i < confettiCount; i++) {
                        var shape = shapes[Math.floor(Math.random() * shapes.length)];
                        confetti.push({
                            x: Math.random() * W,
                            y: Math.random() * -H,
                            w: 8 + Math.random() * 10,
                            h: 8 + Math.random() * 10,
                            angle: Math.random() * 360,
                            d: 2 + Math.random() * 2.5,
                            color: colors[Math.floor(Math.random() * colors.length)],
                            tilt: Math.random() * 10 - 5,
                            shape: shape,
                            rotateSpeed: (Math.random() - 0.5) * 0.2
                        });
                    }

                    function drawConfettiPiece(c) {
                        ctx.save();
                        ctx.translate(c.x, c.y);
                        ctx.rotate(c.angle);
                        ctx.globalAlpha = 0.88;
                        ctx.fillStyle = c.color;
                        if (c.shape === 'rect') {
                            ctx.fillRect(-c.w / 2, -c.h / 2, c.w, c.h / 2);
                        } else if (c.shape === 'triangle') {
                            ctx.beginPath();
                            ctx.moveTo(0, -c.h / 2);
                            ctx.lineTo(-c.w / 2, c.h / 2);
                            ctx.lineTo(c.w / 2, c.h / 2);
                            ctx.closePath();
                            ctx.fill();
                        }
                        ctx.restore();
                    }

                    function draw() {
                        ctx.clearRect(0, 0, W, H);
                        for (var i = 0; i < confetti.length; i++) {
                            drawConfettiPiece(confetti[i]);
                        }
                    }

                    function update() {
                        var allOffScreen = true;
                        for (var i = 0; i < confetti.length; i++) {
                            var c = confetti[i];
                            c.y += c.d + 2.2;
                            c.x += Math.sin(c.y / 30) * 2.2;
                            c.angle += c.rotateSpeed;
                            if (c.y < H + 30) {
                                allOffScreen = false;
                            }
                        }
                        return allOffScreen;
                    }

                    function animate() {
                        draw();
                        var done = update();
                        if (!done) {
                            requestAnimationFrame(animate);
                        } else {
                            canvas.style.display = 'none';
                        }
                    }
                    animate();
                };

                function updateStarProgressBar() {
                    var fields = ['#starTo', '#starThanksFor', '#starST', '#starAR', '#starFrom'];
                    var completed = 0;

                    fields.forEach(function(selector) {
                        var val = $(selector).val();
                        if (val && val.trim().length > 0) {
                            completed++;
                        }
                    });

                    if (getSelectedStarValues().length > 0) {
                        completed++;
                    }

                    var percent = Math.round((completed / (fields.length + 1)) * 100);
                    $('#starProgressBar').css('width', percent + '%');

                    var label = 'Start your STAR story.';
                    if (percent >= 25 && percent < 75) {
                        label = 'Nice! You are on your way — a few more lines and your teammate feels the love.';
                    } else if (percent >= 75 && percent < 100) {
                        label = 'Almost there — pick the value(s) they showed, then save your STAR.';
                    } else if (percent === 100) {
                        label = 'Beautiful! Hit save to send this STAR and brighten a day.';
                        // softly highlight the prizes block once when complete
                        var $prizes = $('.star-prizes-block');
                        if ($prizes.length) {
                            $prizes.removeClass('star-prizes-highlight');
                            // restart animation
                            void $prizes[0].offsetWidth;
                            $prizes.addClass('star-prizes-highlight');
                        }
                        // Confetti celebration (only once per completion)
                        if (!window._starConfettiPlayed) {
                            window._starConfettiPlayed = true;
                            launchStarConfetti();
                        }
                    } else {
                        window._starConfettiPlayed = false;
                    }

                    $('#starProgressLabel').text(label);
                }

                $('#starAppreciationForm textarea').each(function() {
                    if (this.id) {
                        updateStarCharCount(this.id);
                    }
                });

                $('#starAppreciationForm textarea, #starAppreciationForm input, #starTo, #starThanksFor').on(
                    'input',
                    function() {
                        if (this.tagName.toLowerCase() === 'textarea' && this.id) {
                            updateStarCharCount(this.id);
                        }
                        updateStarProgressBar();
                    });

                $(document).on('click', '.star-value-option', function() {
                    $(this).toggleClass('active');
                    updateStarProgressBar();
                });

                $('.star-card textarea').on('focus', function() {
                    $('.star-card').removeClass('active');
                    $(this).closest('.star-card').addClass('active');
                });

                // Set initial active card
                $('.star-card').first().addClass('active');

                $('#starDraftButton').on('click', function(e) {
                    e.preventDefault();

                    var payload = {
                        to_name: $('#starTo').val() ? $('#starTo').val().trim() : '',
                        thanks_for: $('#starThanksFor').val() ? $('#starThanksFor').val().trim() : '',
                        situation_task: $('#starST').val() ? $('#starST').val().trim() : '',
                        action_results: $('#starAR').val() ? $('#starAR').val().trim() : '',
                        selected_values: getSelectedStarValues()
                    };

                    // Basic front-end validation to ensure all fields are filled
                    var missingFieldSelector = null;
                    if (!payload.to_name) missingFieldSelector = '#starTo';
                    else if (!payload.thanks_for) missingFieldSelector = '#starThanksFor';
                    else if (!payload.situation_task) missingFieldSelector = '#starST';
                    else if (!payload.action_results) missingFieldSelector = '#starAR';
                    else if (!payload.selected_values.length) missingFieldSelector = '.star-values-block';

                    if (missingFieldSelector) {
                        var $target = $(missingFieldSelector);
                        if ($target.length && $target.offset()) {
                            $('html, body').animate({
                                scrollTop: Math.max($target.offset().top - 100, 0)
                            }, 250);
                        }
                        $('#starProgressLabel').text(
                            'Please select at least one Megawide value before saving your STAR story.');
                        return;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: starStoreUrl,
                        method: 'POST',
                        dataType: 'JSON',
                        data: payload,
                        success: function(response) {
                            updateStarProgressBar();
                            $('#starProgressLabel').text(
                                'Your STAR story has been saved. Thank you for appreciating a teammate!'
                                );

                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    title: 'STAR submitted!',
                                    text: 'Your STAR story has been recorded successfully.',
                                    icon: 'success',
                                    confirmButtonColor: '#ee2f21'
                                }).then(function() {
                                    $('#exampleModalCenter').modal('hide');
                                });
                            }

                            // Reset the form for a new entry
                            $('#starAppreciationForm')[0].reset();
                            // Restore the From field value (reset keeps default value attribute)
                            $('#starFrom').val($('#starFrom').attr('value'));
                            // Reset counters (STAR textareas)
                            $('#starAppreciationForm textarea').each(function() {
                                if (this.id) {
                                    updateStarCharCount(this.id);
                                }
                            });
                            $('.star-value-option').removeClass('active');
                            window._starConfettiPlayed = false;
                            updateStarProgressBar();
                            $('.star-card').removeClass('active');
                            $('.star-card').first().addClass('active');
                        },
                        error: function(xhr) {
                            $('#starProgressLabel').text(
                                'Something went wrong while saving your STAR story. Please try again.'
                                );
                            console.error(xhr);

                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'We could not save your STAR story. Please try again.',
                                    icon: 'error',
                                    confirmButtonColor: '#ee2f21'
                                });
                            }
                        }
                    });
                });
            }

            // Dear field (starTo) autocomplete using sigla nominees
            if ($('#starTo').length) {
                var $starTo = $('#starTo');
                var $starToSuggestions = $('<div id="starToSuggestions" class="star-to-suggestions"></div>');
                $starTo.after($starToSuggestions);

                function renderStarToSuggestions() {
                    var nomineeList = Array.isArray(window.siglaNominees) ? window.siglaNominees : [];
                    var query = $starTo.val().trim().toUpperCase();

                    if (!query || !nomineeList.length) {
                        $starToSuggestions.hide();
                        return;
                    }

                    var matches = nomineeList.filter(function(item) {
                        if (!item.name) return false;
                        return item.name.toUpperCase().indexOf(query) !== -1;
                    }).slice(0, 8);

                    if (!matches.length) {
                        $starToSuggestions.hide();
                        return;
                    }

                    var html = '';
                    matches.forEach(function(item) {
                        var safeName = $('<div>').text(item.name).html();
                        var upperName = item.name.toUpperCase();
                        var start = upperName.indexOf(query);
                        if (start === -1) {
                            html += '<div class="star-to-suggestion-item" data-name="' + safeName + '">' +
                                safeName + '</div>';
                        } else {
                            var before = safeName.substring(0, start);
                            var match = safeName.substring(start, start + query.length);
                            var after = safeName.substring(start + query.length);
                            html += '<div class="star-to-suggestion-item" data-name="' + safeName + '">' +
                                before + '<span class="star-to-match">' + match + '</span>' + after +
                                '</div>';
                        }
                    });

                    $starToSuggestions.html(html).show();
                }

                $starTo.on('input keyup', function() {
                    renderStarToSuggestions();
                });

                // keyboard navigation for suggestions
                $starTo.on('keydown', function(e) {
                    if (!$starToSuggestions.is(':visible')) return;

                    var $items = $starToSuggestions.find('.star-to-suggestion-item');
                    if (!$items.length) return;

                    var index = $items.index($items.filter('.active'));

                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        index = index < $items.length - 1 ? index + 1 : 0;
                        $items.removeClass('active');
                        $items.eq(index).addClass('active');
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        index = index > 0 ? index - 1 : $items.length - 1;
                        $items.removeClass('active');
                        $items.eq(index).addClass('active');
                    } else if (e.key === 'Enter') {
                        var $active = $items.filter('.active');
                        if ($active.length) {
                            e.preventDefault();
                            var name = $active.data('name');
                            $starTo.val(name);
                            $starTo.trigger('input');
                            $starToSuggestions.hide();
                        }
                    } else if (e.key === 'Escape') {
                        $starToSuggestions.hide();
                    }
                });

                $starTo.on('focus', function() {
                    renderStarToSuggestions();
                });

                $(document).on('click', '.star-to-suggestion-item', function() {
                    var name = $(this).data('name');
                    $starTo.val(name);
                    $starTo.trigger('input');
                    $starToSuggestions.hide();
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.star-dear-row').length) {
                        $starToSuggestions.hide();
                    }
                });
            }
        });

        $('#closeModal').click(function() {
            $('#exampleModalCenter').modal('hide')
        });

        $.ajax({
            url: "/getValidEmployees",
            type: "GET",
            success: function(data) {
                // Store sigla nominees for Dear field suggestions
                if (Array.isArray(data)) {
                    // expose to the existing ready handler via window and local var
                    window.siglaNominees = data;
                }

                let user = $('div.userInfo span b').html().toUpperCase();
                data.forEach(element => {
                    if (element.name && element.name.indexOf(user) >= 0) {
                        $('#exampleModalCenter').modal('show')
                    }
                });
            },
            error: function(e) {
                console.log(e);
            }
        })

        const video = document.getElementById('bannerVideo');

        video.addEventListener('ended', () => {
            // Pause the video at the end
            video.pause();

            // Wait 3 seconds, then replay from the start
            setTimeout(() => {
                video.currentTime = 0;
                video.play();
            }, 7000); // 3000 milliseconds = 3 seconds
        });
    </script>
@endsection
