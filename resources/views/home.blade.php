@extends('layouts.master')

@section('title')
 Dashboard
@endsection

@section('content')

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

@endsection