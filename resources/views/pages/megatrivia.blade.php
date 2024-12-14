@extends('main')

@section('content')
    <div class="container">
        <div class="banner">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <span class="bannerTitle"><span style="color:#ee2f21">MEGA</span>TRIVIA</span>
            </div>
        </div>
        <hr class="hrCustom mt-3 mb-2">
        <span class="breadcrumbCustom">HOME <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
                style="color:#ee2f21">MEGATRIVIA</span></span>
    </div>

    <section class="content mt-3">
        <div class="megatriviaImage" style="background-image: url('{{ $megatrivia->image }}')">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="megatriviaBox">
                            <div class="row d-flex justify-content-center align-items-center ">
                                <img src="https://static.thenounproject.com/png/3968164-200.png" alt=""
                                    style="width: 110px;">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>{!! $megatrivia->content !!}</span>
                                </div>
                            </div>
                            <form data-action="{{ route('submitAnswerMegatrivia') }}" id="submitAnswerMegatrivia">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control {{ $megatrivia->megatriviaAnswers->where('user', $user['contacts']['displayName'])->count() == 1 ? 'disableField' : '' }}"
                                                name="answer" id="answer" autocomplete="off"
                                                placeholder="Type your answer"
                                                style="border: 1px black solid;
                                            background-color: #ffffff00 !important;
                                            border-radius: 10px;">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="megatrivia_id" value="{{ $megatrivia->id }}" id="megatrivia_id">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" id="submitButton" class="btn btn-danger btn-block"
                                            {{ $megatrivia->megatriviaAnswers->where('user', $user['contacts']['displayName'])->count() == 1 ? 'disabled' : '' }}
                                            style="background-color: #ee2f21">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <a href="#"
                                    class="metricStore"
                                    data-action="All Megatrivia"
                                    data-url="/megatrivia/all-megatrivia"
                                    data-value=""
                                    >See other MegaTrivia</a>
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
    <script src="{{ asset('js/megatrivia.js') }}"></script>
@endsection
