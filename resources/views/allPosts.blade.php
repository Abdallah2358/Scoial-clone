@extends('layout')
@section('navlink')
    <a class="nav-link" aria-current="page" href="/logout">Logout</a>
    <a class="nav-link" aria-current="page" href="/friends/{{$user}}">Friends</a>
@endSection
@section('content')
    <main class="px-3">
        <div class="container  row">
            <span class="col-sm mx-5"> Your Posts</span>
            <a class="btn btn-white  col-sm bg-white m-2" href="/posts/create/{{ $posts[0]->get_post()->user_id }}"
                type="button"> Create post </a>
        </div>
        <Form method="POST" action="/users/search">
            @csrf
            <div class="form-group m-2">
                <label for="user"></label>
                <input name="user" type="hidden" value="{{ $user ?? '' }}">
                <input type="text" class="form-control" name="search" aria-describedby="emailHelp"
                    placeholder="Enter username or email">
            </div>
            <button type="submit" class="btn btn-white bg-white m-2">Search </button>
        </form>

        <ul class="list-group row">
            @foreach ($posts as $post)
                <li class="list-group-item">
                    <span> {{ $post->get_post()->created_at }}</span>
                    @if ($post->get_post()->id == $user)
                    <a href="/posts/delete/{{ $post->get_post()->id }}">delete</a>
                    <a href="/posts/edit/{{ $post->get_post()->id }}">edit</a>
                    @endif
                   
                    <p class="">{{ $post->get_post()->comment }}</p>
                    <div class=" container">
                    {{-- likess --}}
                        @php
                        $isliked = null ;
                        @endphp
                        @foreach ( $post->get_likes() as $like )
                            @if ($like->user_id==$user)
                                <a href="/like/delete/{{$like->id}}">dislike</a>
                                @php
                        $isliked = 'yes' ;
                        @endphp
                            @endif
                        @endforeach
                        @if (!$isliked)
                            <a href ='/like/{{$post->get_post()->id }}'>like</a>
                        @endif
                        <span class="col-sm mx-5"> likes : {{ count($post->get_likes()) }}</span>

                        {{-- comment button --}}
                        <Form class="col-sm m-2" method="POST" action="/comment/create">
                            @csrf
                            <input name="user" type="hidden" value="{{ $user }}">
                            <input name="post" type="hidden" value="{{ $post->get_post()->id }}">
                            <button type="submit" class="btn btn-dark"> Comment on post </a>
                        </form>
                        <button class="btn btn-dark col-sm mx-5" type="button" data-toggle="collapse"
                            data-target="#post{{ $postNo }}" aria-expanded="false"
                            aria-controls="post{{ $postNo }}">
                            Comments
                        </button>




                        {{-- show comments --}}
                        <div class="collapse my-2" id="post{{ $postNo++ }}">
                            <ul class="list-group">

                                @foreach ($post->get_comments() as $comment)
                                    <li class="list-group-item">
                                        @if ($comment->user_id == $user)
                                            <a href='/comment/edit/{{$comment->id}}'>edit</a>
                                            <a href="/comment/delete/{{$comment->id}}">delete</a>
                                        @endif
                                        <p>
                                            {{ $comment->content }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>

    </main>
@endSection
