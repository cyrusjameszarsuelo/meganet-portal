@extends('main')

@section('pageLinks')
    <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nomination.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <style>
        span.select2 {
            width: 100% !important;
        }

        .sigla-form label {
            font-family: 'Magistral-Medium';
            font-size: 20px;
        }

        li.select2-selection__choice {
            font-family: 'Magistral-Medium';
            background-color: white !important;
            border-radius: 10px !important;
            padding: 7px !important;
        }
    </style>
    <div class="container mt-3">
        <span class="breadcrumbCustom"><a href="/home">HOME</a> <i class="fa fa-chevron-right ml-2 mr-2"></i>
            <a href="/nomination-mechanics">MECHANICS</a> <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
                style="color:#ee2f21">TEAM NOMINATION</span></span>
    </div>

    <section class="container mt-3 mb-3">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-12 col-lg-6">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('images/Sigla Folder/Community Emailer.png') }}"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('images/Sigla Folder/Excellence Emailer.png') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('images/Sigla Folder/Innovation Emailer.png') }}"
                                    alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('images/Sigla Folder/Integrity Emailer.png') }}"
                                    alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('images/Sigla Folder/Malasakit Emailer.png') }}"
                                    alt="Third slide">
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('images/Sigla Folder/Teamwork Emailer.png') }}"
                                    alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 sigla-form" style="background-color: #0d0d0d; color: #ee2f21;">
                    <div class="text-center">
                        <img src="https://meganet-admin.portalwebsite.net/images/sigla-white.png" alt=""
                            style="width: 13vw;">
                    </div>

                    <form id="nominationGroupForm">
                        <div class="row mr-5 ml-5 mb-3">
                            <div class="col-md-6">
                                <h6 class="card-title">Department:</h6>
                                <p class="card-text">
                                    <select class=" form-select" id="department" required>
                                        <option selected disabled value="">-- SELECT DEPARTMENT -- </option>
                                        @foreach ($siglaDepartments as $department)
                                            <option value="{{ $department->name }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="card-title">Value Exhibited:</h6>
                                <p class="card-text">
                                    <select class="select2bs4" id="valuesMultiple" multiple="multiple"
                                        data-placeholder="Select a Value/s" style="width: 100%;" required>
                                        @foreach ($values as $value)
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="row mr-5 ml-5 mb-2">
                            <h6>Desirable Behavior:</h6>
                            <div class="form-group">
                                <select class="select2bs4" id="behavior" multiple="multiple"
                                    data-placeholder="Select a Behavior" style="width: 100%;" required>
                                </select>
                            </div>
                        </div>
                        <div class="row mr-5 ml-5 mb-2">
                            <h6>Critical Incidents:</h6>
                            <div class="form-group">
                                <textarea class="form-control" id="critical_incidents" style="height: 100px !important;" placeholder="Enter your answer"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row mr-5 ml-5 mb-2">
                            <h6>Result/ Impact:</h6>
                            <div class="form-group">
                                <textarea class="form-control" id="result_impact" style="height: 100px !important;" placeholder="Enter your answer"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row mr-5 ml-5 mb-4">
                            <button id="submitButton" type="submit"
                                class="btn btn-primary float-right btn-block">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('pageScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/nomination-group.js') }}"></script>
@endsection
