@extends('main')

@section('content')

<div class="container mt-4">
    <span class="breadcrumbCustom"><a href="/home">HOME</a>
        <i class="fa fa-chevron-right ml-2 mr-2"></i>
        <a href="/megaprojects/{{$megaproject->id}}"><span style="color:#ee2f21">MEGAPROJECTS</span></a>
        <i class="fa fa-chevron-right ml-2 mr-2"></i>
        <span style="color:#ee2f21">{{$megaproject->segments}}</span>
    </span>
</div>

<section class="container">
    @foreach ($megaproject->megaprojectSegments as $key1 => $item)
        @if($key1 % 2 )
        <section class="mt-3 mb-3 pt-5">
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="row">
                        <div id="carouselExampleIndicators{{$key1}}" class="carousel slide" data-ride="carousel" data-interval="10000">
                            <ol class="carousel-indicators">
                                @forelse ($item->megaprojectSegmentImages as $key => $image)
                                <li data-target="#carouselExampleIndicators{{$key1}}" data-slide-to="{{$key}}"
                                    class="{{$key == 0 ? 'active' : ''}}"></li>
                                @empty
                                @endforelse
                
                            </ol>
                            <div class="carousel-inner">
                                @forelse ($item->megaprojectSegmentImages as $key => $image)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img class="megaprojectCarousel" style="object-position: center; width: 100%; height: 500px; object-fit: cover;"
                                        src="{{ $image->image }}" alt="First slide">
                                </div>
                                @empty
                                @endforelse
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators{{$key1}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators{{$key1}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5 col-12">
                    <div class="">
                        <span class="megaprojectTitle">{{$item->title}}</span>
                        <br>
                        {!!$item->details!!}
                    </div>
                </div>
            </div>
        </section>
        <br>
        <hr>
        @else
        <section class="mt-3 mb-3 pt-5">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="">
                        <span class="megaprojectTitle">{{$item->title}}</span>
                        <br>
                        {!!$item->details!!}
                    </div>
                </div>
                
                <div class="col-md-7 col-12">
                    <div class="row">
                        <div id="carouselExampleIndicators{{$key1}}" class="carousel slide" data-ride="carousel" data-interval="10000">
                            <ol class="carousel-indicators">
                                @forelse ($item->megaprojectSegmentImages as $key => $image)
                                <li data-target="#carouselExampleIndicators{{$key1}}" data-slide-to="{{$key}}"
                                    class="{{$key == 0 ? 'active' : ''}}"></li>
                                @empty
                                @endforelse
                
                            </ol>
                            <div class="carousel-inner">
                                @forelse ($item->megaprojectSegmentImages as $key => $image)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img class="megaprojectCarousel" style="object-position: center; width: 100%; height: 500px; object-fit: cover;"
                                        src="{{ $image->image }}" alt="First slide">
                                </div>
                                @empty
                                @endforelse
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators{{$key1}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators{{$key1}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <hr>
        @endif
    @endforeach
</section>
@endsection