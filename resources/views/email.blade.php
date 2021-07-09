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
			<div class="col-lg-8">
				<div class="card">
        <form method="POST" onsubmit="bodycopy()">
      			@csrf
            <script>
              function bodycopy(){
                document.getElementById('ebody').value = document.getElementById('htmlsource').innerHTML
              }
	          </script>
					<div class="card-body p-4">
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Email Subject</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                <input class="form-control" type="text" name="esub" placeholder="Enter Mail Subject" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Email Body</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                <textarea class="form-control" name="ebody" id="ebody" cols="30" rows="15" style='display:none'></textarea>
                <div id='htmlsource' class="form-control" contenteditable style='padding:1em;width:100%;min-height:25em' ></div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 text-secondary text-center">
              <button  formaction="/all" class="btn btn-danger">Send Mail to All</button>
							</div>
						</div>

            <div class="row mb-3 pt-2">
							<div class="col-sm-3">
								<h6 class="mb-0">Send By College</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                Send Mail to       <select style="width:30%;" name="uni" >
                                      <option hidden disabled selected value>Select University</option>
                                        @foreach($uni as $u)
                                            <option value="{{$u['university']}}">{{$u['university']}}</option>
                                        @endforeach
                                    </select>
                Students &nbsp; &nbsp;
                <button  formaction="/university" class="btn btn-danger">Send Mail</button>
							</div>
						</div>


            <div class="row mb-3 pt-2">
							<div class="col-sm-3">
								<h6 class="mb-0">Send By Group</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                Send Mail to <select style="width:30%;" name="grp" >
                                  <option hidden disabled selected value>Select Group</option>
                                  @foreach($group as $g)
                                      <option value="{{$g['group']}}">{{$g['group']}}</option>
                                  @endforeach
                              </select>
                Students &nbsp; &nbsp;
                <button  formaction="/group" class="btn btn-danger">Send Mail</button>
							</div>
						</div>


            
            <div class="row mb-3 pt-2">
							<div class="col-sm-3">
								<h6 class="mb-0">Send By Section</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                Send Mail to <select style="width:30%;" name="sec" >
                                  <option hidden disabled selected value>Select Section</option>
                                  @foreach($sec as $s)
                                      <option value="{{$s['section']}}">{{$s['section']}}</option>
                                  @endforeach
                              </select>
                Students &nbsp; &nbsp;
                <button  formaction="/section" class="btn btn-danger">Send Mail</button>
							</div>
						</div>


            <div class="row mb-3 pt-2">
							<div class="col-sm-3">
								<h6 class="mb-0">Send By Marks</h6>
							</div>
							<div class="col-sm-9 text-secondary">
                Send Mail to Students having 10th Marks >=
                <input type="text" name="10th" id="" style="width:15%" >
                , 12th Marks >= <input type="text" name="12th" id="" style="width:15%" > 
                , CGPA >= <input type="text" name="cgpa" id="" style="width:15%" >
                <div class="pt-2"><button  formaction="/marks" class="btn btn-danger">Send Mail</button></div>
                <br><i style="color:red;">*Enter 0 in case all are eligible</i>
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