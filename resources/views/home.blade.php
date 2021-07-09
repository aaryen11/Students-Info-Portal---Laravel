@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
@section('content')
  <div class="container">
    <div class="main-body">
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card pt-3 pb-2">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      <img src="{{ asset('profile.png') }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{(Auth::user()->name)}}</h4>
                      <p class="text-secondary mb-1">
                      @if((Auth::user()->usertype) == '1')
                          Admin
                      @elseif((Auth::user()->usertype) == '2')
                          Student
                      @endif
                      </p>
                      <p class="text-secondary mb-1">{{Auth::user()->university_roll_no}}</p>
                      <p class="text-secondary mb-1">{{(Auth::user()->email)}}</p>
                      <p class="text-muted font-size-sm">
                      @if((Auth::user()->university) == 'GEU')
                          Graphic Era Deemed to be University
                      @elseif((Auth::user()->university) == 'GEHU')
                          Graphic Era Hill University
                      @elseif((Auth::user()->university) == 'GEHUB')
                          Graphic Era Hill University, Bhimtal
                      @endif
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fa fa-envelope-o pr-2" style="font-size: 20px;" aria-hidden="true"></i>Email</h6>
                    <span class="text-secondary">{{Auth::user()->email}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fa fa-github pr-2" style="font-size: 20px;" aria-hidden="true"></i>Github</h6>
                    <span class="text-secondary">{{Auth::user()->github_profile}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fa fa-phone pr-2" style="font-size: 20px;" aria-hidden="true"></i>Contact</h6>
                    <span class="text-secondary">{{Auth::user()->phone}}</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Official Email ID</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->official_email_id}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">University Roll No.</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->university_roll_no}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Course</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->course}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Branch</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->branch}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Section</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->section}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">CGPA (Aggregate)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->CGPA}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">12<sup>th</sup> Percentage</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->XII}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">10<sup>th</sup> Percentage</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{Auth::user()->X}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-danger" href="/edit">Edit</a>
                    </div>
                  </div>
                  <br>
                  <a href="/changePassword" style="font-size: 14px;font-style: italic; text-align: center;">
                    * If it's your first login, Kindly change your password by navigating to change password section.
                  </a>
                </div>
              </div>

            </div>
          </div>

        </div>
    </div>
    @section('footer')

@stop

@endsection