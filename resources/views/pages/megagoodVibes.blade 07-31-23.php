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
        <span class="breadcrumbCustom">HOME <i class="fa fa-chevron-right ml-2 mr-2"></i> <span style="color:#ee2f21">MEGAGOOD
                VIBES</span></span>
    </div>

    <section class="container mt-2">
        <div class="megagoodvibesFirst">
            <div class="row">
                <div class="col-md-6 col-12">
                    <video poster="https://res.cloudinary.com/hsrqcgi54/image/upload/v1666090332/f0l6pxwytiewvgnd17sa.jpg"
                        controls style="width: 100%; height: 400px; background-color: rgb(0, 0, 0) !important;">
                        <source
                            src="https://res.cloudinary.com/hsrqcgi54/video/upload/v1666090331/videos/gove7lmheigk1kj9qphg.mp4"
                            type="video/mp4">
                    </video>
                </div>
                <div class="col-md-6 col-12 p-3">
                    <div ccp_infra_version="3" ccp_infra_timestamp="1665566601175" ccp_infra_user_hash="2134689039"
                        ccp_infra_copy_id="4ec8cdd7-3a1e-4f13-a4ef-c10195ee118a" data-ccp-timestamp="1665566601175"
                        style="color: rgb(0, 0, 0); font-size: medium;">
                        <table width="581" style="width: 436pt;">
                            <colgroup>
                                <col width="581" style="width: 436pt;">
                            </colgroup>
                            <tbody>
                                <tr height="20" style="height: 15pt;">
                                    <td width="581" height="20"
                                        style="padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap; width: 436pt; height: 15pt;">
                                        <span style="font-size: 36px; font-family: Helvetica;">Movin' and groovin' is EPC's
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div ccp_infra_version="3" ccp_infra_timestamp="1665566601175" ccp_infra_user_hash="2134689039"
                        ccp_infra_copy_id="4ec8cdd7-3a1e-4f13-a4ef-c10195ee118a" data-ccp-timestamp="1665566601175"
                        style="color: rgb(0, 0, 0); font-size: medium;">
                        <table width="581" style="width: 436pt;">
                            <tbody>
                                <tr height="20" style="height: 15pt;">
                                    <td width="581" height="20"
                                        style="padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap; width: 436pt; height: 15pt;">
                                        <span style="font-size: 36px; font-family: Helvetica;">"8990 Urban Deca Ortigas
                                            Army" </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div ccp_infra_version="3" ccp_infra_timestamp="1665566601175" ccp_infra_user_hash="2134689039"
                        ccp_infra_copy_id="4ec8cdd7-3a1e-4f13-a4ef-c10195ee118a" data-ccp-timestamp="1665566601175"
                        style="color: rgb(0, 0, 0); font-size: medium;">
                        <table width="581" style="width: 436pt;">
                            <tbody>
                                <tr height="20" style="height: 15pt;">
                                    <td width="581" height="20"
                                        style="padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap; width: 436pt; height: 15pt;">
                                        <span style="font-size: 36px; font-family: Helvetica;">getting their Permission To
                                            Dance&nbsp;</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-end" style="height: 160px">
                        <div class="row">
                            <div class="col-12">
                                <i class="fa-regular fa-heart" style="font-size: 20px"></i>
                                <i class="fa-regular fa-comment ml-2" style="font-size: 20px"></i>
                                <i class="fa-regular fa-paper-plane ml-2" style="font-size: 20px"></i>
                            </div>
                            <div class="col-md-10"></div>
                            <div class="col-md-12 mt-2">
                                <input type="text" class="form-control" placeholder="Add a comment"
                                    style="height: 40px !important;
                                border-radius: 11px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-md-12">
                <div class="row">
                    <span class="extraTitleMeganet">Archives</span>
                </div>
                <div class="row">
                    <hr class="megawideHr">
                </div>
                <div class="row">
        
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="carousel-wrap">
                                <div class="owl-carousel">
                                    @foreach ($megagoodVibes as $megagoodVibe)
                                        <div class="item">
                                            <img
                                                src="{{$megagoodVibe->thumbnail}}">
                                            {{-- <div class="row text-center">
                                                <span>{{date("F", mktime(0, 0, 0, $megagoodVibe->month, 1))}} {{$megagoodVibe->year}}</span>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('pageScripts')
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
@endsection
