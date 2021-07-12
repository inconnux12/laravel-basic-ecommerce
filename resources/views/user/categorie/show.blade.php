@extends('user.Layouts.app')
@section('content')
    <div class="row">
            @if (count($products)>0)
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="/image/{{!empty($product->image->name) ? $product->image->name:'photo.jpg'}}" height="250px;" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">{!!$product->desc!!} </p>
                    <a href="{{route('product.show',['product'=>$product->slug])}}" class="btn btn-primary">{{$product->categorie->title}}</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-center py-4">
                {!!$products->links()!!}
            </div>
            @endif   
    </div>
@endsection