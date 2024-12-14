@extends('main')

@section('content')
    <div class="container mt-3">
        {{-- <div class="banner">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <span class="bannerTitle"><span style="color:#ee2f21">OUR</span> COMPANY</span>
            </div>
        </div> --}}
        {{-- <hr class="hrCustom mt-4 mb-2"> --}}
        <span class="breadcrumbCustom"><a href="/home">HOME</a> <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
                style="color:#ee2f21">OUR COMPANY</span></span>
    </div>

    <section class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                <img class="ourCompanyImage" src="{{ asset('images/megawide-building.png') }}" alt="">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        {!! $ourCompany ? $ourCompany->content : '' !!}
                    </div>
                    {{-- <div class="col-md-12  col-12">
                        <span class="titleMeganet"> <span style="color: #ee2f21">WHO</span> WE ARE</span>
                        <br>
                        <span class="ourCompanyContent">Megawide Construction Corporation (MCC) is a publicly-listed
                            engineering and infrastructure firm established in 1997. MCC has assets in Construction; Precast
                            and Construction Solutions; and infrastructure development.</span>
                    </div>
                    <div class="col-md-12 mt-3 col-12">
                        <span class="titleMeganet"><span style="color: #ee2f21">WHAT</span> WE DO</span>
                        <br>
                        <span class="ourCompanyContent">
                            <a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">
                                <li>CONSTRUCTION</li>
                            </a>
                            <a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">
                                <li>PRECAST AND CONSTRUCTION SOLUTIONS</li>
                            </a>
                            <a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">
                                <li>AIRPORT</li>
                            </a>
                            <a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">
                                <li>LANDPORT</li>
                            </a>
                            <a href="/our-company/details">
                                <li>INFRASTRUCTURE MODERNIZATION</li>
                            </a>
                        </span>
                    </div> --}}

                    <div class="col-md-12 mt-3 text-right">
                        <span class="ourCompanyContent" style="font-weight: bold"><a href="/our-company/details"><i
                                    class="fa-solid fa-caret-right"></i> READ MORE</a></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
