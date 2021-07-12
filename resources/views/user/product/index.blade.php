@extends('user.Layouts.app')
@section('content')
<section class="tabs">
  <div class="row">
      <div class="col-12">
          <h1>Latest Products</h1>
      </div>
  </div>
  <div class="row">
      <div class="col">
          <div class="container w-50">
            @foreach ($categories as $categorie)
              <div id="tab-1" class="tab-item  ">
                  <p>{{$categorie->title}}</p>
              </div>
            @endforeach
          </div>
      </div>
  </div>
</section>
<section class="tab-content my-5 py-3 bg-secondary mx-5 d-75">
  <div class="container  ">
      <!-- Tab Content 1 -->
      
      @if (count($products)>0)
      <div id="tab-1-content" class="tab-content-item show">
          <div class="row ">
            @foreach ($products as $product)
              <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                  <div class="card">
                      <img class="card-img-top" src="/image/{{!empty($product->image_name) ? $product->image_name:'photo.jpg'}}" height="350px" alt="Card image cap">
                      <div class="card-body">
                          <h5 class="card-title text-center  ">{{$product->name}}</h5>
                          <h4 class="text-center"> ${{$product->price}}</h4>
                          <div class="text-center"><i class="fa fa-star star"></i><i class="fa fa-star star"></i><i class="fa fa-star star"></i><i class="fa fa-star star"></i></div>
                          <div class="text-center">
                              <p>100 viewers</p>
                          </div>
                          <p class="card-text text-center">{!!$product->desc!!}</p>
                          <div class="text-center">

                              <!-- Button trigger modal for details-->
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="" data-bs-target="#ModalDetails{{$product->id}}">
                                  More details
                              </button>
                              @include('user.show')
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center py-4">
            {!!$products->links()!!}
        </div>
        @else
        <div class="card text-center">
            <div class="card-header">
              Products
            </div>
            <div class="card-body">
              <h5 class="card-title">Sorry their is no products </h5>
              <p class="card-text">please comeback again when we add prodcuts</p>
            </div>
          </div>
        @endif   
    </div>
</section>
@endsection