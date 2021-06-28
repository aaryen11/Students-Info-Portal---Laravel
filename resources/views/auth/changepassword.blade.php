@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pt-3"  style="border-radius:10px 10px 10px 10px; opacity:0.85; display:inline-block; margin-top:11%;">
            <div class="card-body">
                <img src="{{ asset('logo.gif') }}" style='width:100%;height:20%'>
                </div>

                <div class="card-body">
                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




               














