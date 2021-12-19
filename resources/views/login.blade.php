@extends('layout')
 @section('navlink')
     <a class="nav-link" aria-current="page" href="/register">Register</a>
 @endSection
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
                <label for="user"></label>
                <input type="text" class="form-control" name="user" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group m-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-white bg-white m-2">Submit</button>
        </form>
    </main>
@endSection
