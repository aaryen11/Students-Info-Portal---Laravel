@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

@section('content')

	<div class="container">
    <div class="main-body">
	@if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
        @endif
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card pt-3 pb-2">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      <img src="{{ asset('profile.png') }}" alt="Profile" class="rounded-circle" width="150">
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
                  <div class="row" style="justify-content:center;">
                  
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4 p-2">
                      <div class="text-center p-2" style="border-radius: .25rem;background-color: #F5F5F5;width: 100%;"><div style="font-size: 28px;">{{$data['tests_attempted']}}</div>Tests Taken</div>
                    </div>
                    <div class="col-sm-4 p-2">
                        <div class="text-center p-2" style="border-radius: .25rem;background-color: #F5F5F5;width: 100%;"><div style="font-size: 28px;">{{$data['total_marks']}}%</div>Perfromance</div>
                        <input type="text" hidden disabled name="marks" id="marks" value="{{$data['tmarks']}}">
                        <input type="text" hidden disabled name="test_attempt" id="test_attempt" value="{{$data['tests_attempted']}}">
                    </div>
                    <div class="col-sm-4 p-2">
                      <div class="text-center p-2" style="border-radius: .25rem;background-color: #F5F5F5;width: 100%;"><div style="font-size: 28px;">{{$rank}}</div>Rank</div>
                  </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Remarks</h6>
                      (From last test)
                    </div>
                    <div class="col-sm-9">
                        <div class="p-2" style="border-radius: .25rem;background-color: #F5F5F5;width: 100%;">{{$data['remarks']}}</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
    <script>
    var xValues = [0]
    for(var i=1;i<=parseInt(document.getElementById('test_attempt').value)+1;i++){
      xValues.push(i)
    }
    var yValues = document.getElementById('marks').value.split(",");
    
    new Chart("myChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(0,0,255,1.0)",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      options: {
        legend: {display: false},
        scales: {
          yAxes: [{ticks: {min: 0, max:100}}],
          xAxes: [{ticks: {min: 0, max:30}}],
        }
      }
    });
    </script>
    @section('footer')

	@stop

@endsection