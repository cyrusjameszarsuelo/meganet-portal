@extends('main')

@section('pageLinks')
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/animate.css-master/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="banner">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <span class="bannerTitle"><span style="color:#ee2f21">MEGA</span>NEWS</span>
            </div>
        </div>
        <hr class="hrCustom mt-4 mb-2">
        <span class="breadcrumbCustom"><a href="/home">HOME</a> <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
                style="color:#ee2f21">MEGANEWS</span></span>
    </div>

    <section class="container mt-3">
        <div class="row">
            <ul class="nav nav-pills mb-3 nav-justified mt-5" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="content-tab" data-bs-toggle="pill" data-bs-target="#content"
                        type="button" role="tab" aria-controls="content" aria-selected="true">Content</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pdfs-tab" data-bs-toggle="pill" data-bs-target="#pdfs" type="button"
                        role="tab" aria-controls="pdfs" aria-selected="false">PDFs</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="20000">
                        <br>
                        <br>

                        <div class="carousel-inner">
                            @forelse ($meganews as $key => $meganewsData)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        <div class="col-md-8 col-6">
                                            @if ($meganewsData->meganews_images->first())
                                                @if ($meganewsData->meganews_images->first()->image[0] == 'h')
                                                    <img class="meganewsCarousel"
                                                        src="{{ $meganewsData->meganews_images->first()->image }}"
                                                        alt="First slide">
                                                @else
                                                    <img class="meganewsCarousel"
                                                        src="https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/{{ $meganewsData->meganews_images->first()->image }}"
                                                        alt="First slide">
                                                @endif
                                            @else
                                            @endif

                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="row text-center">
                                                <span class="extraTitleMeganet"> <span
                                                        style="color: #ee2f21; font-size: 30px">{{ date('F', mktime(0, 0, 0, $meganewsData->month, 1)) }}
                                                        {{ $meganewsData->year }}</span></span>
                                            </div>
                                            <span class="articleTitle">{{ $meganewsData->title }}</span>
                                            <br>
                                            <br>
                                            {!! strip_tags(Str::words($meganewsData->content, 30, '...')) !!}
                                            <br>
                                            <br>
                                            <span>
                                                <a href="#" class="metricStore" data-action="Meganews"
                                                    data-url="/meganews/details/{{ $meganewsData->id }}"
                                                    data-value="{{ $meganewsData->id }}">Read More</a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            @empty
                            @endforelse


                            <div class="row align-items-end" style="height: 370px">
                                <div class="col-md-8 col-12">

                                </div>
                                <div class="col-md-4 col-12">
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <ol class="carousel-indicators">
                                        @foreach ($meganews as $key => $meganewsData)
                                            <li data-target="#carouselExampleIndicators"
                                                data-slide-to="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }}"></li>
                                        @endforeach

                                    </ol>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <section class="container">
                        <div class="row mt-3 mb-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <span class="extraTitleMeganet">Archives</span>
                                </div>
                                <div class="row">
                                    <hr class="megawideHr">
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="carousel-wrap">
                                    <div class="owl-carousel">
                                        @foreach ($meganewsGroups as $meganewsGroup)
                                            <div class="item">
                                                <a
                                                    href="/meganews/{{ $meganewsGroup->year }}-{{ sprintf('%02d', $meganewsGroup->month) }}">
                                                    @if ($meganewsGroup->meganews_images->first())
                                                        @if ($meganewsGroup->meganews_images->first()->image[0] == 'h')
                                                            <img
                                                                src="{{ $meganewsGroup->meganews_images->first()->image }}">
                                                        @else
                                                            <img
                                                                src="https://meganet-portal-admin.atwebpages.com/uploads/Meganews-Images/{{ $meganewsGroup->meganews_images->first()->image }}">
                                                        @endif
                                                    @else
                                                    @endif
                                                    <div class="row text-center">
                                                        <span
                                                            class="text-black">{{ date('F', mktime(0, 0, 0, $meganewsGroup->month, 1)) }}
                                                            {{ $meganewsGroup->year }}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane fade" id="pdfs" role="tabpanel" aria-labelledby="pdfs-tab">
                    @if ($user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph' || $user['contacts']['mail'] == 'jjpascua@megawide.com.ph')
                        <object data="{{ asset('MegaNews Q22024 Issue 1.pdf') }}" type="application/pdf"
                            style="width: 100%; height: 100vh">
                            <p>Alternative text - include a link <a href="{{ asset('MegaNews Q22024 Issue 1.pdf') }}">to
                                    the
                                    PDF!</a>
                            </p>
                        </object>
                    @else
                        <div class="row">
                            <div class="text-center">
                                <hr>
                                <h1>Coming Soon!</h1>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('pageScripts')
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
@endsection
