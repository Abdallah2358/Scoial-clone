@extends('layout')
 @section('navlink')
     <a class="nav-link" aria-current="page" href="/logout">Logout</a>
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
                    <p class="">{{ $post->get_post()->comment }}</p>
                    <div class=" container">
                        <span class="col-sm mx-5"> likes : {{ $post->get_likes() }}</span>

                        <button class="btn btn-dark col-sm mx-5" type="button" data-toggle="collapse"
                            data-target="#post{{ $postNo }}" aria-expanded="false"
                            aria-controls="post{{ $postNo }}">
                            Comments
                        </button>
                        <button class="btn btn-dark col-sm mx-2" type="button"> Comment on post </button>
                        <div class="collapse my-2" id="post{{ $postNo++ }}">


                            <ul class="list-group">

                                @foreach ($post->get_comments() as $comment)
                                    <li class="list-group-item">
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
