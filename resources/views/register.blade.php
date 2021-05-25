@extends('layout')
@section('content')
    <main class="px-3">
        <Form method = "POST" action ="/user">
    @csrf
            <div class="form-group m-2">
                <label for="">First Name</label>
                <input type="text" class="form-control" Name="firstName" aria-describedby="emailHelp"
                    placeholder="First Name">
            </div>
            <div class="form-group m-2">
                <label for=""> username</label>
                <input type="text" class="form-control" Name="userName" aria-describedby="emailHelp"
                    placeholder="username">
            </div>

            <div class="form-group m-2">
                <label for=""> Email address</label>


                <input type="email" class="form-control" Name="email" aria-describedby="emailHelp"
                    placeholder="Enter email">

            </div>

            <div class="form-group m-2">
                <label for="">Password</label>


                <input type="password" class="form-control" Name="password" aria-describedby="emailHelp"
                    placeholder="Password">

            </div>

            <div class="form-group m-2">
                <label for="">Last Name</label>
                <input type="text" class="form-control" Name="lastName" aria-describedby="emailHelp"
                    placeholder="Last Name">

            </div>

            <div class="form-group m-2">
                <label for="">Gender</label>
                <select Name = "gender" class="custom-select">
                    <option value="1">One</option>
                </select>
            </div>

            <div class="form-group m-2  container">
                <label class="row m-2" for="">date</label>
                <div class="row m-2">
                    
                        <input class="col-sm mx-5" Name= "day" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="DD">
                        <input class="col-sm mx-5" Name= "month"  type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="MM">
                        <input class="col-sm mx-5" Name= "year" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="YY">
                   
                </div>

            </div>
            <button variant="primary" type="submit">
                Register
            </button>
        </Form>
    </main>
@endSection
