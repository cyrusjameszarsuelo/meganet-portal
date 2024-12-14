@extends('main')

@section('pageLinks')
    <link href="{{ asset('css/ourCompanyCarousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/animate.css-master/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-3">
        <div class="mt-3">
            <span class="breadcrumbCustom"><a href="/home">HOME </a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <span style="color:#ee2f21">Megawide Construction</span>
            </span>
        </div>
    </div>

    <section class="container mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <img class="corporateOfficeImage" src="" alt="">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <a class="btn btn-primary text-white btn-block btn-lg " style="font-size: 14px; background-color: #ee2f21"
                    href="/megawide-construction/manuals-policies">
                    <i class="fa fa-book"></i> Manuals/Policies</a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-success text-white btn-block btn-lg " style="font-size: 14px; background-color: #7c7c7c"
                    href="/megawide-construction/templates-forms">
                    <i class="fa fa-book"></i> Templates/Forms</a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-warning text-white btn-block btn-lg " style="font-size: 14px; background-color: #000"
                    href="/megawide-construction/powerpoint-presentation">
                    <i class="fa fa-book"></i> Powerpoint Presentations</a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-info text-white btn-block btn-lg " style="font-size: 14px; background-color: #fff; color: black !important;"
                    href="/megawide-construction/others">
                    <i class="fa fa-book"></i> Others</a>
            </div>
        </div>
    </section>
@endsection

@section('pageScripts')
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/ourCompanyCarousel.js') }}"></script>
@endsection
