@extends('frontend.layouts.master')

@section('main')

     <div class="container text-center">
         <br>
         <h4 >Cart</h4>
         <hr>

         @if(session()->has('message'))
             <div class="alert alert-success">
                 {{session()->get('message')}}
             </div>
         @endif

         @if(empty($cart))
             <div class="alert alert-info">
                 Cart is empty. Please add products to your cart.
             </div>
         @else
             <table class="table table-bordered table-hover mt-3">
                 <thead>
                 <tr>
                     <th>Serial</th>
                     <th>Product</th>
                     <th>Unit Price</th>
                     <th>Quantity</th>
                     <th>Price</th>
                     <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
                 @php
                     $i = 1
                 @endphp
                 @foreach($cart as $key => $product)
                     <tr>
                         <td>{{$i++}}</td>
                         <td>{{$product['title']}}</td>
                         <td>{{number_format($product['unit_price'],2)}}</td>
                         <td><input type="number" name="quantity" value="{{$product['quantity']}}"></td>
                         <td>BDT {{$product['total_price']}}</td>
                         <td>
                             <form action="{{route('cart.remove')}}" method="POST">
                                 @csrf
                                 <input type="hidden" name="product_id" value="{{$key}}">
                                 <button type="submit" class="btn btn-danger">X</button>
                             </form>
                         </td>
                     </tr>
                 @endforeach
                 <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <th>Total</th>
                     <th>BDT {{number_format($total,2)}}</th>
                     <td></td>
                 </tr>

                 </tbody>
             </table>

             <a href="{{route('cart.clear')}}" class="btn btn-warning btn-block">Clear Cart</a>
         @endif


     </div>

@endsection
