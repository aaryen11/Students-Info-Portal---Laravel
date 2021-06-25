@extends('layouts.app')

@section('content')
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/select/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/main.css') }}">
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="/save" method="POST">
      @csrf
				<span class="contact100-form-title">
					<b>Edit Profile</b>
				</span>
        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


				<div class="wrap-input100 validate-input">
					<span class="label-input100">Name</span>
					<input class="input100" type="text" name="name" value="{{(Auth::user()->name)}}" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Email</span>
					<input class="input100" type="text" name="email" value="{{(Auth::user()->email)}}" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Official Email</span>
					<input class="input100" type="text" name="oemail" value="{{(Auth::user()->official_email_id)}}" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Contact No.</span>
					<input class="input100" type="text" name="phone" value="{{(Auth::user()->phone)}}" required>
					<span class="focus-input100"></span>
				</div>

                <div class="wrap-input100 validate-input">
					<span class="label-input100"> Course</span>
					<input class="input100" type="text" name="course" value="{{(Auth::user()->course)}}" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100"> Branch</span>
					<input class="input100" type="text" name="branch" value="{{(Auth::user()->branch)}}" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100"> Section</span>
					<input class="input100" type="text" name="section" value="{{(Auth::user()->section)}}" required>
					<span class="focus-input100"></span>
				</div>

				<div class="profile-card-inf__item">
          			<div class="profile-card-inf__txt"><button class="btn btn-danger w-100">Update Details</button></div>
        		</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>
	<script src="{{ secure_asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ secure_asset('css/select/select2.min.js') }}"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
@endsection
