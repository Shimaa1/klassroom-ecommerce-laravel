@extends('frontend.layouts.master')

@section('main')

    <div class="container">
        <br>
        <h4 class="text-center">My Profile</h4>
        <hr>
    </div>
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone Number</th>
                    <th>Paid Amount</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->customer_name}}</td>
                    <td>{{$order->customer_phone_number}}</td>
                    <td>{{number_format($order->paid_amount,2)}}</td>
                    <td>{{number_format($order->total_amount,2)}}</td>
                    <td><a href="{{route('order.details', $order->id)}}" class="btn btn-info btn-sm">Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
