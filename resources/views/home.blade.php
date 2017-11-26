@extends('layouts.master')

@section('title')
 Dashboard
@endsection

@section('content')

<div class="title m-b-md">
                    @auth
                        {{ Auth::user()->name }}
                        <p>{{ Auth::user()->email }}</p>
                        @if (Auth::user()->picture)
                            <p><img src="{{ Auth::user()->picture }}"></p>
                        @endif
                    @else
                        OpenID Connect
                    @endauth
                </div>

@endsection
