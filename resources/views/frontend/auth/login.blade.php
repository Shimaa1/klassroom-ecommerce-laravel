@extends('frontend.layouts.master')

@section('main')

    <div class="container">
        <br>
        <h4 class="text-center">Log in</h4>
        <hr>

        @include('frontend.partials._message')

        <form action="{{route('login')}}" class="form" method="post">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" required placeholder="Enter your Email...">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" required placeholder="Enter your password..">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">Login</button>
            </div>

        </form>


    </div>

@endsection
