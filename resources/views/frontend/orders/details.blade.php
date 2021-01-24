@extends('frontend.layouts.master')

@section('main')

    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success mt-4">
                {{session('message')}}
            </div>
        @endif
        <br>
        <h4 class="text-center">Order Details</h4>
        <hr>
    </div>
    
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item"><b>Customer Name:</b> {{$order->customer_name}}</li>
            <li class="list-group-item"><b>Customer Phone Number:</b> {{$order->customer_phone_number}}</li>
            <li class="list-group-item"><b>Address:</b> {{$order->address}}</li>
            <li class="list-group-item"><b>City:</b> {{$order->city}}</li>
            <li class="list-group-item"><b>Postal Code:</b> {{$order->postal_code}}</li>

        </ul>

        <h4 class="text-success text-center mt-5">Ordered Products</h4>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                <tr>
                    <td>{{$product->product->title}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{number_format($product->price,2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
