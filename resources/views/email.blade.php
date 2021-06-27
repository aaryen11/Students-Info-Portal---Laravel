@extends('layouts.app')

@section('content')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/select/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	<div class="container-contact100">
		<div class="wrap-contact100 w-75">
			<form class="contact100-form validate-form" action="/all" method="POST">
      @csrf
				<span class="contact100-form-title">
					<b>Send Mail</b>
				</span>
        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
				<div class="wrap-input100 validate-input">
					<span class="label-input100">Enter Subject</span>
					<input class="input100" type="text" name="esub" placeholder="Enter Mail Subject" required>
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input">
					<span class="label-input100">Enter Mail Body</span>
					<textarea class="input100" name="ebody" id="ebody" cols="30" rows="15" style='display:none'></textarea>
					<div id='htmlsource' class="input100" contenteditable style='border:hidden;padding:1em;width:100%;min-height:25em' ></div>
					<span class="focus-input100"></span>
				</div>

                <div class="profile-card-inf__item text-center">
          			<div class="profile-card-inf__txt"><button class="btn btn-danger w-25" type="submit">Send Mail to All</button></div>
        		</div>


				<div class="input50-select text-center pt-4">
                    Send By College : Send Mail to
						<select style="width:15%;!important" name="uni" >
                            <option hidden disabled selected value>Select University</option>
                            @foreach($uni as $u)
                                <option value="{{$u['university']}}">{{$u['university']}}</option>
                            @endforeach
						</select>
						Students &nbsp; &nbsp;
                    <button  formaction="/university" class="btn btn-danger w-25">Send Mail</button>
				</div>

				<div class="input50-select text-center pt-4">
                    Send By Group : Send Mail to
						<select style="width:15%;!important" name="grp" >
                            <option hidden disabled selected value>Select Group</option>
                            @foreach($group as $g)
                                <option value="{{$g['group']}}">{{$g['group']}}</option>
                            @endforeach
						</select>
						Students &nbsp; &nbsp;
						<button  formaction="/group" class="btn btn-danger w-25">Send Mail</button>
				</div>

				<div class="input50-select text-center pt-4">
                    Send By Section : Send Mail to Section
						<select style="width:15%;!important" name="sec" >
                            <option hidden disabled selected value>Select Section</option>
                            @foreach($sec as $s)
                                <option value="{{$s['section']}}">{{$s['section']}}</option>
                            @endforeach
						</select>
						Students &nbsp; &nbsp;
						<button  formaction="/section" class="btn btn-danger w-25">Send Mail</button>
				</div>


				<div class="text-center pt-4">
                    Send By Marks : Send Mail to Students having 10th Marks >=
						<input type="text" name="10th" id="" style="width:5%" >
					, 12th Marks >= <input type="text" name="12th" id="" style="width:5%" > 
					, CGPA >= <input type="text" name="cgpa" id="" style="width:5%" >
                    <button  formaction="/marks" class="btn btn-danger w-25">Send Mail</button>
					<br><i style="color:red;">*Enter 0 in case all are eligible</i>
				</div>

			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('css/select/select2.min.js') }}"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		jQuery(function(){
    jQuery('form').submit( function(e) {
        jQuery('textarea').val( jQuery('#htmlsource').html() );
      });
});
	</script>
@endsection
