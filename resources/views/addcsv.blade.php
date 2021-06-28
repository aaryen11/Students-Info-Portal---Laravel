@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pt-3"  style="border-radius:10px 10px 10px 10px; opacity:0.85; display:inline-block; margin-top:11%;">
            <div class="card-body">
                <img src="http://btechgeu.in/images/logo_graphic_era.gif" style='width:100%;height:20%'>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/upload" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                        <label for="userid" class="col-md-4 col-form-label text-md-right">{{ __('Add CSV File') }}</label>
                            <div class="col-md-6">
                                <input id="dbfile" type="file" class="form-control @error('dbfile') is-invalid @enderror" required autofocus name="dbfile">

                                @error('dbfile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                        * File Required in CSV Format - <a href="https://convertio.co/" target="_blank">Convert Here</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('footer')

    @stop
</div>
@endsection
