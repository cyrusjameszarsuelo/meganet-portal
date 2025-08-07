@extends('main')

@section('content')
    <div class="container">
        <div class="mt-3">
            <span class="breadcrumbCustom"><a href="/home">HOME </a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <a href="/megatrivia">MEGATRIVIA</a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <span style="color:#ee2f21">All Trivias</span>
            </span>
        </div>

        <section class="mt-4">
            <div class="row">
                <h4><b>All MegaTrivia</b></h4>
                <hr class="hrTitle">
            </div>
        </section>

        <section class="articles mt-3 mb-3">
            <div class="row">
                @foreach ($megatrivia as $megatriviaData)
                    <div class="col-md-4">
                        <article>
                            <div class="article-wrapper">
                                <figure>
                                    <img src="{{ $megatriviaData->image }}" alt="" />
                                </figure>
                                <div class="article-body">
                                    <span><i class="fa-regular fa-clock"></i>
                                        {{ $megatriviaData->created_at->diffForHumans() }}
                                    </span>
                                    <h2>{{ $megatriviaData->title }}</h2>
                                    <p>
                                        {!! $megatriviaData->content !!}
                                    </p>
                                    <span>Answer:
                                        @if ($megatriviaData->megatriviaAnswers->where('user', $user['displayName'])->count() == 1)
                                            @php
                                                $possibleAnswers = json_decode($megatriviaData->answer, true);
                                            @endphp
                                            @if (is_array($possibleAnswers))
                                                {{ implode(', ', $possibleAnswers) }}
                                            @else
                                                {{ $megatriviaData->answer }}
                                            @endif
                                        @endif
                                    </span>
                                    <br>
                                    <span>By:
                                        @php
                                            $possibleAnswers = json_decode($megatriviaData->answer, true);
                                            $isArrayAnswer = is_array($possibleAnswers);
                                            $firstCorrectUser = null;
                                        @endphp
                                        @forelse ($megatriviaData->megatriviaAnswers as $item)
                                            @php
                                                $isCorrectAnswer = false;
                                                if ($isArrayAnswer) {
                                                    foreach ($possibleAnswers as $correctAnswer) {
                                                        if (
                                                            strtolower(trim($correctAnswer)) ===
                                                            strtolower(trim($item->answer))
                                                        ) {
                                                            $isCorrectAnswer = true;
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $isCorrectAnswer =
                                                        trim(strtolower($item->answer)) ==
                                                        trim(strtolower($megatriviaData->answer));
                                                }

                                                if ($isCorrectAnswer && !$firstCorrectUser) {
                                                    $firstCorrectUser = $item->user;
                                                }
                                            @endphp
                                        @empty
                                        @endforelse
                                        {{ $firstCorrectUser }}
                                    </span>
                                    <br>
                                    {{-- @if (
                                        $megatriviaData->megatriviaAnswers->where('user', $user['displayName'])->count() == 1 ||
                                            ($user['mail'] == 'cjzarsuelo@megawide.com.ph' ||
                                                $user['mail'] == 'jjpascua@megawide.com.ph' ||
                                                $user['mail'] == 'jnmaramba@megawide.com.ph'))
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <a type="button" data-toggle="modal"
                                                    data-target="#correctAnswers{{ $megatriviaData->id }}"><span
                                                        style="font-size: 13px; color:#ee2f21">With Correct
                                                        Answers</span></a>
                                            </div>
                                            <div class="col-6 text-center">
                                                <a type="button" data-toggle="modal"
                                                    data-target="#incorrectAnswers{{ $megatriviaData->id }}"><span
                                                        style="font-size: 13px; color:#ee2f21">With Incorrect
                                                        Answers</span></a>
                                            </div>
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    @foreach ($megatrivia as $megatriviaData)
        <div class="modal fade" id="correctAnswers{{ $megatriviaData->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Correct Answers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="megatriviaAnswerList">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Names</th>
                                    <th>Answer</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $possibleAnswers = json_decode($megatriviaData->answer, true);
                                    $isArrayAnswer = is_array($possibleAnswers);
                                @endphp
                                @forelse ($megatriviaData->megatriviaAnswers as $item)
                                    @php
                                        $isCorrectAnswer = false;
                                        if ($isArrayAnswer) {
                                            foreach ($possibleAnswers as $correctAnswer) {
                                                if (
                                                    strtolower(trim($correctAnswer)) === strtolower(trim($item->answer))
                                                ) {
                                                    $isCorrectAnswer = true;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $isCorrectAnswer =
                                                trim(strtolower($megatriviaData->answer)) ==
                                                trim(strtolower($item->answer));
                                        }
                                    @endphp
                                    @if ($isCorrectAnswer)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user }}</td>
                                            <td>{{ $item->answer }}</td>
                                            <td><img src="{{ asset($item->image) }}" alt="" width="80"></td>
                                        </tr>
                                    @endif
                                @empty
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($megatrivia as $megatriviaData)
        <div class="modal fade" id="incorrectAnswers{{ $megatriviaData->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Incorrect Answers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="megatriviaAnswerList">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Names</th>
                                    <th>Answer</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $possibleAnswers = json_decode($megatriviaData->answer, true);
                                    $isArrayAnswer = is_array($possibleAnswers);
                                @endphp
                                @forelse ($megatriviaData->megatriviaAnswers as $item)
                                    @php
                                        $isCorrectAnswer = false;
                                        if ($isArrayAnswer) {
                                            foreach ($possibleAnswers as $correctAnswer) {
                                                if (
                                                    strtolower(trim($correctAnswer)) === strtolower(trim($item->answer))
                                                ) {
                                                    $isCorrectAnswer = true;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $isCorrectAnswer =
                                                trim(strtolower($megatriviaData->answer)) ==
                                                trim(strtolower($item->answer));
                                        }
                                    @endphp
                                    @if (!$isCorrectAnswer)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user }}</td>
                                            <td>{{ $item->answer }}</td>
                                            <td><img src="{{ asset($item->image) }}" alt="" width="80"></td>
                                        </tr>
                                    @endif
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('pageScripts')
    <script src="{{ asset('js/megatrivia.js') }}"></script>
@endsection
