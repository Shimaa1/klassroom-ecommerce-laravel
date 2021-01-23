@extends('frontend.layouts.master')

@section('main')

    <div class="container text-center">
        <br>
        <h4 >Checkout</h4>
        <hr>

        @guest()
            <div class="alert alert-info">
                You need to <a href="">Login</a> first to complete your order.
            </div>
        @else
            <div class="alert alert-info">
                You are ordering as <b>{{auth()->user()->name}}</b>.
            </div>
        @endguest

    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{count($cart)}}</span>
                </h4>
                <ul class="list-group mb-3">
                    
                    @foreach ($cart as $key => $product)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$product['title']}}</h6>
                            <small class="text-muted">Quantity : {{$product['quantity']}}</small>
                        </div>
                        <span class="text-muted">Tk {{number_format($product['total_price'],2)}}</span>
                    </li>
                    @endforeach

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong>{{number_format($total,2)}}</strong>
                    </li>
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>

                @include('frontend.partials._message')
                <form class="needs-validation" action="{{route('order')}}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{auth()->user()->name}}" placeholder="Customer Name" required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone_number">Customer Phone Number</label>
                        <input type="text" class="form-control" id="customer_phone_number" name="customer_phone_number" value="{{auth()->user()->phone_number}}" placeholder="Customer Phone Number" required>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        {{-- <input type="text" class="form-control" id="address" placeholder="1234 Main St" required> --}}
                        <textarea name="address" id="address" cols="15" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <input type="text" name="city" placeholder="City" id="city" class="form-control">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" placeholder="Postal Code" id="postal_code" class="form-control">
                        </div>
                    </div>
     
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>

@endsection
