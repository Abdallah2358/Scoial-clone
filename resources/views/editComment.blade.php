@extends('layout')
@section('content')
    <main class="px-3">
        <form method="POST" action="/comment/update/{{ $id }}">
            @csrf

            <div class="form-group">
                <label for="comment" class="form-control m-3">edit comment</label>
                <textarea id="comment" class="form-control m-3" name="comment" rows="4" cols="50"
                    maxlength="1000">{{ $comment }}</textarea>
            </div>
            <button type="submit" class="btn btn-white bg-white m-2">Submit</button>
        </form>
    </main>
@endSection
