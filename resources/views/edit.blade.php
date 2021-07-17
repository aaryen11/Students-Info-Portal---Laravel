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
				<form action="/save" method="POST"  enctype="multipart/form-data">
      			@csrf
					<div class="card-body p-4">
					<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Avatar</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="file" class="form-control" name="profile" value="{{(Auth::user()->profile)}}">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Name</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="name" value="{{(Auth::user()->name)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Email ID</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="email" value="{{(Auth::user()->email)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Official Email ID</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="oemail" value="{{(Auth::user()->official_email_id)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">University Roll No.</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="university_roll_no" value="{{(Auth::user()->university_roll_no)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Contact No.</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="phone" value="{{(Auth::user()->phone)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Github Profile</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="github" value="{{(Auth::user()->github_profile)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Course</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="course" value="{{(Auth::user()->course)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Branch</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="branch" value="{{(Auth::user()->branch)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Section</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="section" value="{{(Auth::user()->section)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">CGPA (Aggregate)</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="number" class="form-control" step="any" name="cgpa" value="{{(Auth::user()->CGPA)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">12<sup>th</sup> Percentage</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="number" class="form-control" step="any" name="12th" value="{{(Auth::user()->XII)}}" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">10<sup>th</sup> Percentage</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="number" class="form-control" step="any" name="10th" value="{{(Auth::user()->X)}}" required>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 text-secondary">
								<button class="btn btn-danger px-4">Update Details</button>
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
