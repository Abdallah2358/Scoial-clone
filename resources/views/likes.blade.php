@extends('layout')
@section('navlink')
    <a class="nav-link" aria-current="page" href="/logout">Logout</a>
    <a class="nav-link" aria-current="page" href="/friends/{{ $id }}">friends</a>
@endSection
@section('content')
<h2>Friends You Chated With</h2>
    <ul class="list-group row">

        @foreach ($friends_chat_count as $key => $friend)
            <li class="list-group-item">
                {{$key}} : {{ $friend}}  
            </li>

        @endforeach
    </ul>

@endSection
