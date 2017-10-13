@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="bg-bill-error">
                    You have an overdue payment, so you don't currently have full access to our learning material. If you're ready to start learning again,
                    <a href=""> click here to update your payment method.</a>
                </div>

            </div>


            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel">
                    <div id="curriculum" class="panel-body">
                        <strong>Quiz</strong>
                        <h2>{{ $quiz->name  }}</h2>
                        <hr>
                       {{ $quiz->description  }}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-12 col-lg-12">

                @if (count($questionnaires) > 0)

                    <div class="panel panel-success card-curriculum">
                        <div class="panel-heading bg-auburn">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            &nbsp;{{ $tutorials->programminglanguage->name }} Quiz : {{ $quiz->name }}
                        </div>

                        <div class="panel-body latte-quiz">
                            <form class="form-horizontal" method="POST" action="{{ route('createAnswer') }}">
                                {{ csrf_field() }}
                            <?php $i=1; ?>
                            @foreach($questionnaires as $questionnaire)
                                Question # {{ $i }} <br>
                                    <kbd> {{ $questionnaire->question_text }} </kbd> <br>
                                    <code>{{ $questionnaire->code_snippet }}</code>
                                <br>
                                <?php $i++ ?>

                                    <input type="hidden" value="{{ $questionnaire->id }}" name="questionnaire_id[{{$questionnaire->id}}]">
                                    @if ($questionnaire->choice1 != "")
                                    <label class="radio-inline">
                                        <input type="radio" name="answer[{{ $questionnaire->id }}]" value="{{ $questionnaire->choice1 }}">{{ $questionnaire->choice1 }}
                                    </label>
                                    @endif

                                    <br>
                                    @if ($questionnaire->choice2 != "")
                                    <label class="radio-inline">
                                        <input type="radio" name="answer[{{ $questionnaire->id }}]" value="{{ $questionnaire->choice2 }}">{{ $questionnaire->choice2 }}
                                    </label>
                                    @endif

                                    <br>
                                    @if ($questionnaire->choice3 != "")
                                    <label class="radio-inline">
                                        <input type="radio" name="answer[{{ $questionnaire->id }}]" value="{{ $questionnaire->choice3 }}">{{ $questionnaire->choice3 }}
                                    </label>
                                    @endif
                                    <br>

                                    @if ($questionnaire->choice4 != "")
                                    <label class="radio-inline">
                                        <input type="radio" name="answer[{{ $questionnaire->id }}]" value="{{ $questionnaire->choice4 }}">{{ $questionnaire->choice4 }}
                                    </label>
                                    @endif

                                    <br>
                                    @if ($questionnaire->choice5 != "")
                                    <label class="radio-inline">
                                        <input type="radio" name="answer[{{ $questionnaire->id }}]" value="{{ $questionnaire->choice5 }}">{{ $questionnaire->choice5 }}
                                    </label>
                                    @endif
                                    <br><br>
                            @endforeach
                                <button id="quiz-btn" type="submit"  class="btn btn-success btn-lg btn-flat pull-right">Submit Quiz</button>
                            </form>
                        </div>
                    </div>

                @endif
            </div>

        </div>

        @include('users.footer')

    </div>
@endsection
