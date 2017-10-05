@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>جمع امتیاز شما تا این لحظه   :   {{ Sentinel::getUser()->total_score }}</h3>
                </div>
            </div>
            <div class="jumbotron">
                <a href="{{url('questions')}}"><button class="btn btn-primary">ورود به آزمون</button></a>
            </div>
        </div>
    </div>

@endsection
