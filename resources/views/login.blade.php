@extends('layout')
@section('content')
    @if ($auth ?? '')
        <script>
            alert("Authentication Failed")

        </script>
    @endif
    <main class="px-3">
        <Form method="POST" action="/posts">
            @csrf
            <div class="form-group m-2">
                <label for="email"></label>
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group m-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-white bg-white m-2">Submit</button>
        </form>
    </main>
@endSection
