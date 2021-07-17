@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  

	<div class="container">
    <div class="main-body">
	@if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
        @endif
    
        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
        @endif
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card pt-3 pb-2">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      <img src="{{(Auth::user()->profile)}}" alt="Profile" class="rounded-circle" width="150">
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
			<div class="col-lg-8">
				<div class="card">
        <form method="POST">
      			@csrf
            <script>
              function bodycopy(){
                //document.getElementById('remarks').value = document.getElementById('htmlsource').innerHTML
              }
	          </script>
					<div class="card-body p-4">
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Enter Email Address</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                <input class="form-control" type="text" name="email" placeholder="Enter Email Address" required>
							</div>
						</div>
            <div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Enter Marks</h6>
							</div>
							<div class="col-sm-5 text-secondary">
                <input class="form-control" type="number" step="any" name="marks" placeholder="Enter Marks Scored" required>
							</div>
              <div class="col-sm-4 text-secondary">
                <input class="form-control" type="number" step="any" name="tmarks" placeholder="Enter Total Marks" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Remarks</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="15" style=''></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 text-secondary text-center">
              <button  formaction="/postmarks" class="btn btn-danger">Post Marks</button>
							</div>
						</div>
					</div>
          </form>
				</div>
			</div>
          </div>
        </div>
    </div>
    @section('footer')

	@stop

@endsection