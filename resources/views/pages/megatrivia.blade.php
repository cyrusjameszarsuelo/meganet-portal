@extends('main')

@section('pageLinks')
    <link href="{{ asset('assets/custom/css/megatrivia.css?v=1.0.0') }}" rel="stylesheet">

@endsection

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
        <div class="megatriviaImage" style="background-image: url('{{ $megatrivia->image }}'); ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 megatrivia-content-column">
                        <div class="content-text">
                            <div class="row">
                                <span
                                    style="background-color: #ee2f21; color: white; padding: 5px 10px; border-radius: 10px; font-weight: 900; font-size: 19px;">
                                    Your weekly dose of MegaNews - and a chance to win!
                                </span>
                            </div>
                            <div class="row mt-5">
                                <span
                                    style="font-size: 32px; font-weight: 900;">{{ strip_tags($megatrivia->content) }}</span>
                            </div>
                            <div class="row">
                                <div class="mt-3 ">
                                    <span style="font-size: 19px">Get it right and win a </span><span
                                        style="font-size: 24px; font-weight: 900">Megawide Wallet
                                        Finder!</span> <img src="{{ asset('images/megawide-wallet.png') }}"
                                        alt="Megawide Wallet Finder" width="100px" height="100px">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6 megatrivia-column">
                        <div class="megatriviaBox">
                            <div class="content-wrapper">
                                <div class="row d-flex justify-content-center align-items-center mt-lg-5">
                                    <img src="https://static.thenounproject.com/png/3968164-200.png" alt=""
                                        style="width: 80px;">
                                </div>

                                <form data-action="{{ route('submitAnswerMegatrivia') }}" id="submitAnswerMegatrivia">
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control megatrivia-form-control {{ $megatrivia->megatriviaAnswers->where('user', $user['displayName'])->count() == 1 ? 'disableField' : '' }}"
                                                    name="answer" id="answer" autocomplete="off"
                                                    placeholder="Type your answer">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input type="file" name="image" id="image"
                                        class="form-control megatrivia-form-control mb-3"> --}}
                                    <input type="hidden" name="megatrivia_id" value="{{ $megatrivia->id }}"
                                        id="megatrivia_id">
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <button type="submit" id="submitButton"
                                                class="btn float-right megatrivia-submit-btn"
                                                {{ $megatrivia->megatriviaAnswers->where('user', $user['displayName'])->count() == 1 ? 'disabled' : '' }}>
                                                SUBMIT
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-3">
                                    <div class="col-md-12 mt-3">
                                        <a href="#" class="metricStore megatrivia-link" data-action="All Megatrivia"
                                            data-url="/megatrivia/all-megatrivia" data-value="">See other MegaTrivia</a>
                                    </div>
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
