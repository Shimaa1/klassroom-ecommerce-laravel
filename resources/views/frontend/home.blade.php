@extends('frontend.layouts.master')

@section('main')

    @include('frontend.partials._hero')

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <a href="{{route('product.details', $product->slug)}}">
                                <img class="card-img-top" src="{{$product->getFirstMediaUrl('products')}}" alt="{{$product->title}}">
                            </a>
                            <div class="card-body">
                                <p class="card-text"><a href="{{route('product.details', $product->slug)}}">{{$product->title}}</a></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form action="{{route('cart.add')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">ADD TO CART</button>
                                        </form>
                                    </div>
                                    <strong class="text-muted">
                                        @if($product->sale_price !== null && $product->sale_price > 0)
                                            BDT: <strike>{{$product->price}}</strike> | BDT: {{$product->sale_price}}
                                        @else
                                            BDT: {{$product->price}}
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$products->links()}}

        </div>H
    </div>

@endsection
