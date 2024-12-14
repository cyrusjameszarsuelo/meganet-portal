@extends('main')

@section('pageLinks')
<link href="{{ asset('css/megaproject.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="banner">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <span class="bannerTitle"><span style="color:#ee2f21">MEGA</span>PROJECTS</span>
        </div>
    </div>
    <hr class="hrCustom mt-4 mb-2">
    <span class="breadcrumbCustom">HOME <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
            style="color:#ee2f21">MEGAPROJECTS</span></span>
</div>

<div class="content  mt-3 mb-3">
    <div class="row">
        <div class="col-12">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <span class="titleMeganet" style="font-size: 2.5em;">{{$megaprojects->segments}}</span>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <hr class="megawideHr">
            </div>
        </div>
    </div>
</div>

<section class="container mt-3 mb-3">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="10000">
            <ol class="carousel-indicators">
                @forelse ($megaprojects->megaprojectSegments as $key => $item)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
                    class="{{$key == 0 ? 'active' : ''}}"></li>
                @empty
                @endforelse

            </ol>
            <div class="carousel-inner">
                @forelse ($megaprojects->megaprojectSegments as $key => $item)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <img class="megaprojectCarousel" style="object-position: center"
                        src="{{ $item->megaprojectSegmentImages->first()->image }}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="row">
                            <div class="offset-md-7 col-md-5">
                                <div class="contentCarousel">
                                    <h5>{{$item->title}}</h5>
                                    {!!$item->details!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<section class="container mb-3">
    <div class="row mt-3 mb-3">
        <div class="col-md-12">
            <div class="row">
                <span class="extraTitleMeganet">Segments</span>
            </div>
            <div class="row">
                <hr class="megawideHr">
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($megaprojectsAll as $key => $megaproject)
                <div class="col-md-3 text-center">
                    <a href="/megaprojects/megaproject-details/{{$megaproject->id}}">
                        <img class="megaProjectsImages"
                            src="{{ isset($megaproject->megaprojectSegments->first()->megaprojectSegmentImages) ? $megaproject->megaprojectSegments->first()->megaprojectSegmentImages->first()->image : '' }}"
                            alt="">
                        <span><b>{{ $megaproject->segments }}</b></span>
                    </a>
                </div>
        @empty
        @endforelse
    </div>
</section>
@endsection