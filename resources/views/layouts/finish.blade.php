@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="container">
            <div class="jumbotron">
                <div class="page-header">
                    <div class="alert alert-info">
                        <h3>آزمون به پایان رسید</h3>
                    </div>
                </div>
                <p><a href="{{url('profile')}}">مشاهده امتیاز</a></p>
            </div>
        </div>
    </div>

@endsection
