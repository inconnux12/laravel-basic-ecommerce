@extends('user.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card" style="width: 30rem;">
        <div class="card-img-top">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  @for ($i = 0; $i < count($product->images); $i++)   
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{($i==0)?'active':''}}"></li>
                  @endfor
                </ol>
                <div class="carousel-inner">
                  @foreach ($product->images as $i=>$image)
                      <div class="carousel-item {{($i==0)?'active':''}}">
                        <img class="d-block w-100" src="/image/{{!empty($image->name) ? $image->name:'photo.jpg'}}"  height="250px">
                      </div>
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
        <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{!!$product->desc!!} </p>
        <h5>{{$product->unit->stock}} </h5>
        <a href="{{route('categorie.show',['categorie'=>$product->categorie->slug])}}" class="card-title">{{$product->categorie->title}}</a>
        <a href="{{route('buy',['product'=>$product->slug])}}" class="card-text">buy this product</a>
        </div>
    </div>
</div>    
@endsection