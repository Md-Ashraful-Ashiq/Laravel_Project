@extends('layouts.app')

@section('content')

<div class="text-center">
<b><h1>Welcome : {{ Auth::user()->name }}</b></h1>


@endsection