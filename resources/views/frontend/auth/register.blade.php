@extends('frontend.layouts.master')

@section('main')

    <div class="container">
        <br>
        <h4 class="text-center">Register an Account</h4>
        <hr>

        @include('frontend.partials._message')

        <form action="{{route('register')}}" class="form" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required placeholder="Enter your full name...">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" required placeholder="Enter your Email...">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{old('phone_number')}}" required placeholder="Enter your phone number...">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" required placeholder="Enter your password..">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">Register</button>
            </div>


        </form>


    </div>

@endsection
