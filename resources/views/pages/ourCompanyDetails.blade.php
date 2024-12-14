@extends('main')

@section('pageLinks')
    <link href="{{ asset('css/ourCompanyCarousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/animate.css-master/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-3">
        {{-- <div class="banner">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <span class="bannerTitle"><span style="color:#ee2f21">OUR</span> COMPANY</span>
            </div>
        </div> --}}
        {{-- <hr class="hrCustom mt-4 mb-2"> --}}
        <div class="mt-3">
            <span class="breadcrumbCustom"><a href="/home">HOME </a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <a href="/our-company">OUR COMPANY</a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <span style="color:#ee2f21">WHAT WE DO</span>
            </span>
        </div>
    </div>

    <section class="container mt-5 mb-3">
        <div class="row">
            <div class="col-5">
                <div class="row no-gutters">
                    <div class="col-md-5 col-12 d-flex justify-content-center align-items-center">
                        <span class="missionVision">OUR VISION</span>
                    </div>
                    <div class="col-md-7 col-12 pl-4">
                        <span style="font-family: 'Montserrat-Bold';">We will be a First-World Philippines.</span>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row no-gutters">
                    <div class="col-md-4 col-12 d-flex justify-content-center align-items-center">
                        <span class="missionVision">OUR MISSION</span>
                    </div>
                    <div class="col-md-8 col-12 pl-4">
                        <span style="font-family: 'Montserrat-Bold';">
                            We will be at the forefront of
                            building a First-World Philippines
                            through engineering excellence
                            and innovations.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="carousel-wrap">
                    <div class="owl-carousel">
                        <div class="item">
                            <div class="row no-gutters">
                                <div class="col-md-2 col-12 d-flex justify-content-center align-items-center ">
                                    <span class="ourValues">OUR VALUES</span>
                                </div>
                                <div class="col-md-10 col-12 ">
                                    <div class="row groupBg no-gutters">
                                        <div class="col-md-3 col-12 d-flex justify-content-center align-items-center ">
                                            <span style="color: #ee2f21">EXCELLENCE</span>
                                        </div>
                                        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center ">
                                            <span class="descriptionValues">We consistently try to do well in in whatever we
                                                take on, great or small,
                                                because
                                                we owe it to ourselves to try and become better in what we do.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('images/our-company/excellence.jpg') }}">

                        </div>
                        <div class="item">
                            <div class="row no-gutters">
                                <div class="col-md-2 col-12 d-flex justify-content-center align-items-center ">
                                    <span class="ourValues">OUR VALUES</span>
                                </div>
                                <div class="col-md-10 col-12 ">
                                    <div class="row groupBg no-gutters">
                                        <div class="col-md-3 col-12 d-flex justify-content-center align-items-center ">
                                            <span style="color: #ee2f21">TEAMWORK</span>
                                        </div>
                                        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center ">
                                            <span class="descriptionValues">We are all on the same team, driven by the same
                                                purpose. We help fuel each
                                                other’s ideal, support each other’s efforts, and trust each other instead of
                                                competing against one another.

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('images/our-company/teamwork.png') }}">

                        </div>
                        <div class="item">
                            <div class="row no-gutters">
                                <div class="col-md-2 col-12 d-flex justify-content-center align-items-center ">
                                    <span class="ourValues">OUR VALUES</span>
                                </div>
                                <div class="col-md-10 col-12 ">
                                    <div class="row groupBg no-gutters">
                                        <div class="col-md-3 col-12 d-flex justify-content-center align-items-center ">
                                            <span style="color: #ee2f21">INNOVATION</span>
                                        </div>
                                        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center ">
                                            <span class="descriptionValues">We do not fear change but embrace it. Taking the
                                                chance to reinvent
                                                ourselves and our industry. We keep ourselves open to new ideas and fresh
                                                perspectives and look for better ways to deliver our output.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('images/our-company/innovations.png') }}">

                        </div>
                        <div class="item">
                            <div class="row no-gutters">
                                <div class="col-md-2 col-12 d-flex justify-content-center align-items-center ">
                                    <span class="ourValues">OUR VALUES</span>
                                </div>
                                <div class="col-md-10 col-12 ">
                                    <div class="row groupBg no-gutters">
                                        <div class="col-md-3 col-12 d-flex justify-content-center align-items-center ">
                                            <span style="color: #ee2f21">INTEGRITY</span>
                                        </div>
                                        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center ">
                                            <span class="descriptionValues">We are moved to action by the people and ideas
                                                that we care deeply about,
                                                such as our families, colleagues. and our desire for a better life for
                                                ourselves and our fellow Filipinos.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('images/our-company/integrity.png') }}">

                        </div>
                        <div class="item">
                            <div class="row no-gutters">
                                <div class="col-md-2 col-12 d-flex justify-content-center align-items-center ">
                                    <span class="ourValues">OUR VALUES</span>
                                </div>
                                <div class="col-md-10 col-12 ">
                                    <div class="row groupBg no-gutters">
                                        <div class="col-md-3 col-12 d-flex justify-content-center align-items-center ">
                                            <span style="color: #ee2f21">MALASAKIT</span>
                                        </div>
                                        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center ">
                                            <span class="descriptionValues">We practice the Filipino concept of compassion
                                                because we consider
                                                Megawide family, and wherever we are, our community.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('images/our-company/malasakit.png') }}">

                        </div>
                        <div class="item">
                            <div class="row no-gutters">
                                <div class="col-md-2 col-12 d-flex justify-content-center align-items-center ">
                                    <span class="ourValues">OUR VALUES</span>
                                </div>
                                <div class="col-md-10 col-12 ">
                                    <div class="row groupBg no-gutters">
                                        <div class="col-md-3 col-12 d-flex justify-content-center align-items-center ">
                                            <span style="color: #ee2f21">COMMUNITY</span>
                                        </div>
                                        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center ">
                                            <span class="descriptionValues">Our actions affect the communities that we work
                                                with, and so we partner
                                                with them to ensure that we can leave lasting positive social impact through
                                                our projects.

                                                Previous
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('images/our-company/community.png') }}">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('pageScripts')
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/ourCompanyCarousel.js') }}"></script>
@endsection
