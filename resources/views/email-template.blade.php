@extends('beautymail::templates.ark')

@section('content')
<br>
<br>
@include('beautymail::templates.ark.contentStart')

{!! $msg !!}

@include('beautymail::templates.ark.contentEnd')


@stop