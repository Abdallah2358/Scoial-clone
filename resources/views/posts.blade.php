@extends('layout')
@section('content')
    <main class="px-3">
        Your Posts
        <ul class="list-group">


            @foreach ($posts as $post)
                <li class="list-group-item">
                    <span> {{ $post->created_at }}</span>
                    <p class="">{{ $post->comment }}</p>
                    <div class=" container">
                         <span > likes :  </span>
                         <span > likes :  </span>
                    </div>
                </li>
            @endforeach

        </ul>

    </main>
@endSection
