@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Progress</div>

                <div class="panel panel-warning">
                    <div class="panel-heading ">
                        <h1 class="panel-title">Quiz Results</h1>
                    </div>

                    <div class="panel-body">
                        @if(count($usersquizanswers)>0)
                            @foreach($usersquizanswers as $usersquizanswer)
                                <div class="panel-group">
                                    <div class="panel {{ $usersquizanswer->quiz_status == 1 ? 'panel-success' : 'panel-danger' }}">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <strong><a data-toggle="collapse" href="#collapse{{$usersquizanswer->id}}">{{$usersquizanswer->quiz->name}}</a></strong>
                                                <strong class="pull-right">{{ $usersquizanswer->score }} / {{ $usersquizanswer->items }} |</strong>
                                                <strong class="pull-right">{{ $usersquizanswer->quiz_status == 1 ? 'PASSED' : 'FAILED' }} |&nbsp;&nbsp;</strong>
                                                <strong class="pull-right">Date Taken: {{ $usersquizanswer->created_at }} |&nbsp;&nbsp;</strong>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$usersquizanswer->id}}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Question</th>
                                                                <th>Answer Explanation</th>
                                                                <th>Code Snippet</th>
                                                                <th>Info Link</th>
                                                                <th>Correct Answer</th>
                                                                <th>Your Answer</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($usersquizanswer->usersquestionnairesanswer as $questionnaire)
                                                                <tr class="{{ $questionnaire->questionnaires->correct_answer == $questionnaire->answer ? 'bg-success' : 'bg-danger' }}">
                                                                    <td>{{$questionnaire->questionnaires->question_text}}</td>
                                                                    <td>{{$questionnaire->questionnaires->answer_explanation}}</td>
                                                                    <td>{{$questionnaire->questionnaires->code_snippet}}</td>
                                                                    <td>{{$questionnaire->questionnaires->more_info_link}}</td>
                                                                    <td>{{$questionnaire->questionnaires->correct_answer}}</td>
                                                                    <td>{{$questionnaire->answer}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>


            </div>

            <div class="col-xs-12 col-md-12 col-lg-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading ">
                            <h1 class="panel-title">Curriculum</h1>
                        </div>

                        @if(count($userscourse) > 0)
                            @foreach($userscourse as $index => $usercourse)
                            <div class="panel-body">

                                <div class="panel panel-default">
                                    <div class="panel-heading ">
                                        <strong><a data-toggle="collapse" href="#collapseC{{$usercourse->id}}">{{$usercourse->course->name}}</a></strong>
                                    </div>

                                    <div id="collapseC{{$usercourse->id}}" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <section class="timeline">
                                                <ol>
                                                    @foreach($tutorials as $index => $tutorial)
                                                        <li>
                                                            @if(isset($userstutorial[$index]->tutorial_id))
                                                                @if($tutorial->id == $userstutorial[$index]->tutorial_id )
                                                                    <div class="bg-success">
                                                                        <code class="pull-right">Visited</code>
                                                                        <time>{{$tutorial->name }}</time> {{$tutorial->description}}
                                                                    </div>
                                                                @else
                                                                    <div class="bg-default">
                                                                        <time>{{$tutorial->name }}</time> {{$tutorial->description}}
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="bg-default">
                                                                    <time>{{$tutorial->name }}</time> {{$tutorial->description}}
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    <li></li>

                                                </ol>

                                                <div class="arrows">
                                                    <button class="arrow arrow__prev disabled" disabled>
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/arrow_prev.svg" alt="prev timeline arrow">
                                                    </button>
                                                    <button class="arrow arrow__next">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/arrow_next.svg" alt="next timeline arrow">
                                                    </button>
                                                </div>
                                            </section>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        @endif

                    </div>
            </div>

    </div>

        @include('users.footer')
    </div>

@endsection
