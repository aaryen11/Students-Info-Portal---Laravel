@extends('layouts.app')

@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

<div class="wrapper" style="padding-top:3%">
<div class="profile-card js-profile-card ">
    <div class="profile-card__cnt js-profile-cnt">
      <div class="profile-card__name">{{(Auth::user()->name)}}</div><br>
      <div class="profile-card__txt">{{(Auth::user()->department)}}</strong></div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            @if((Auth::user()->university) == 'GEU')
                Graphic Era Deemed to be University
            @elseif((Auth::user()->university) == 'GEHU')
                Graphic Era Hill University
            @elseif((Auth::user()->university) == 'GEHUB')
                Graphic Era Hill University, Bhimtal
            @endif
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Email : {{Auth::user()->email}}
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Official Email : {{Auth::user()->official_email_id}}
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Section : {{Auth::user()->section}}
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Group : {{Auth::user()->group}}
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Contact No. : {{Auth::user()->phone}}
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Course : {{Auth::user()->course}}
        </span>
      </div><br>
      <div class="profile-card-loc">
        <span class="profile-card-loc__txt">
            Branch : {{Auth::user()->branch}}
        </span>
      </div><br>
      <div class="profile-card-inf">
      @if((Auth::user()->usertype) == '1')
        <div class="profile-card-inf__item">
        <div class="profile-card-inf__txt"><a href="/upload"><button class="btn btn-danger">Upload Student Records</button></a></div>
        </div>
        <div class="profile-card-inf__item">
        <div class="profile-card-inf__txt"><a href="/download"><button class="btn btn-danger">Download Student Records</button></a></div>
        </div>
        <div class="profile-card-inf__item">
        <div class="profile-card-inf__txt"><a href="/delete"><button class="btn btn-danger">Delete Records</button></a></div>
        </div>
        @endif

        @if((Auth::user()->usertype) == '1'||(Auth::user()->usertype) == '2')
        <div class="profile-card-inf__item">
          <div class="profile-card-inf__txt"><a href="/edit"><button class="btn btn-danger">Update Details</button></a></div>
        </div>
        @endif
        <a href="/changePassword" class="pt-4">
        * If it's your first login, Kindly change your password by navigating to change password section.
        </a>
        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
        @endif
    </div>

  </div>
</div>
<div class="padding-top:12%; margin-bottom:-12%"><span style="color:white; float:right;">Coded with &hearts; by <b>Kunal Aaryen Sinha</b></span></div>
@endsection


        
                     