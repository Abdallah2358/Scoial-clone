@extends('layout')
@section('content')
    <main class="px-3">

        @if ($results)
            <ul class="list-group row">
                @foreach ($results as $result)

                    <li class="list-group-item">
                        <h2>{{ $result->user->username }}</h2>
                        <p>{{ $result->user->bio }}</p>
                        <button class="btn btn-dark col-sm mx-5" type="button" data-toggle="collapse"
                            data-target="#user{{ $userNo }}" aria-expanded="false"
                            aria-controls="user{{ $userNo }}">
                            START CHATTING !
                        </button>
                        <div class="collapse m-5" id="user{{ $userNo++ }}">
                            <span> No. of messages :{{$result->count}}</span>
                            <ul class="list-group row">
                                @foreach ($result->messages as $message)

                                    <li class="list-group-item">
                                    <span>{{$message->created_at}}</span>
                                    <span>{{$message->from_user_id==$user ? 'me : ':'Them : '}}</span>

                                    <p>{{$message->message}}</p> </li>
                                @endforeach
                            </ul>
                            <Form method="POST" action="/chats">
                                @csrf
                                <div class="form-group m-2">
                                    <label for="user"></label>
                                    <input name="from" type="hidden" value="{{ $user }}">
                                    <input name="to" type="hidden" value="{{ $result->user->id }}">
                                    <input name="toUserName" type="hidden" value="{{ $result->user->username }}">

                                    <input type="text" class="form-control" name="chat" placeholder="Say Hi !">
                                </div>
                                <button type="submit" class="btn btn-white bg-white m-2">Send</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <h1>No USER FOUND !</h1>
        @endif

    </main>
@endSection
