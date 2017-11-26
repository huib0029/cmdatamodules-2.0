@extends('layouts.master')

@section('page-title')
 OpenIDConnect
@endsection

@section('title')
 Selecteer provider:
@endsection

@section('content')
  <a href="{{ $link }}">
    <img src="img/btn_google_signin_dark_normal_web@2x.png">
  </a>
@endsection

@section('scripts')
@endsection
