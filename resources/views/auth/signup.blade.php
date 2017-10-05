@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (session('fail'))
                    <div class="alert alert-warning" style="text-align: center; border: 2px solid #8A6D3B; margin-top: 2%;">
                        <h4 style="font-weight: bold;"><i class="fa fa-warning"></i> {{ session('fail') }}</h4>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" style="text-align: center; border: 2px solid #3C763D; margin-top: 2%;">
                        <h4 style="font-weight: bold;"><i class="fa fa-check"></i> {{ session('success') }}</h4>
                    </div>
                @endif
                <div class="panel panel-default signup-panel">
                    <div class="panel-heading">عضویت در آزمون آنلاین</div>
                    <div class="panel-body">
                        <form id="signup-form" action="{{route('auth.signup')}}" method="post" class ='form-horizontal'>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-3 col-xs-12 control-label pull-right">نام</label>
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="نام">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-3 col-xs-12 control-label pull-right">نام خانوادگی</label>
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="نام خانوادگی">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-3 col-xs-12 control-label pull-right">نام کاربری</label>
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="نام کاربری">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 col-xs-12 control-label pull-right">پست الکترونیک</label>
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="پست الکترونیک">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-3 col-xs-12 control-label pull-right">رمز عبور</label>
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="رمز عبور">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                                {{--<label for="password-confirm" class="col-md-3 control-label pull-right">تایید رمز عبور</label>--}}
                                {{--<div class="col-md-6 pull-right">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="تایید رمز عبور">--}}
                                    {{--@if ($errors->has('password_confirmation'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="col-md-3 col-xs-12 control-label pull-right">شماره همراه</label>
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <input id="phone_number" type="tel" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="شماره همراه">
                                    @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class='btn btn-primary'>
                                        <i class="fa fa-user-plus"></i> ثبت عضویت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
