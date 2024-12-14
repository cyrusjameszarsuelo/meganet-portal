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
                <span style="color:#ee2f21">OUR BUSINESSES AND SUBSIDIARIES</span>
            </span>
        </div>
    </div>

    <section class="container mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="carousel-wrap">
                    <div class="owl-carousel">
                        @foreach ($ourBas as $ourBasData)
                            <div class="item">
                                <img src="{{ 'https://meganet-portal-admin.atwebpages.com/uploads/Our-Businesses-and-Subsidiaries/' . $ourBasData->image }}">
                            </div>
                        @endforeach
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
