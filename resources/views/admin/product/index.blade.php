@extends('admin.Layouts.app')
@section('content')
    <div class="row">
            @if (count($products)>0)
            <div class="d-flex justify-content-between">
                <a class="btn btn-success" href="{{route('admin.product.create')}} ">add new product</a>
                <form action="{{route('admin.product.index')}} " class="d-inline-block col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="GET">  
                    <div class="input-group mb-3"> 
                        <select class="form-select" name="categorie" onchange="tables(null,null,null,this.value,this.nextElementSibling.firstElementChild)">
                          <option value="all">All</option>
                          @foreach ($categories as $categorie)
                            <option value="{{$categorie->slug}}">{{$categorie->title}}</option>
                          @endforeach
                        </select>
                        <div class="input-group-append">
                          <input type="search" name="q" class=" border border-secondary form-control form-control-dark" placeholder="Search..." onkeyup="tables(null,null,null,document.querySelector('select').value,this.value)">
                        </div>
                    </div>
                </form>
            </div>
            <div class="table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-name-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-name-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/name/{{($old['name']??'DESC')}}" class="text-decoration-none" target="{{$old['name']??'DESC'}}"  old="{{key($old)??''}}" onclick="event.preventDefault();tables('name',this.getAttribute('target'),this.getAttribute('old'),document.querySelector('select').value,document.querySelector('input.border').value)">name</a>
                        </th>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-title-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-title-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/title/{{($old['title']??'DESC')}}" class="text-decoration-none" target="{{$old['title']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault();tables('title',this.getAttribute('target'),this.getAttribute('old'),document.querySelector('select').value,document.querySelector('input.border').value)">categorie</a>
                        </th>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-price-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-price-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/price/{{($old['price']??'DESC')}}" class="text-decoration-none" target="{{$old['price']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault();tables('price',this.getAttribute('target'),this.getAttribute('old'),document.querySelector('select').value,document.querySelector('input.border').value)">price</a>
                        </th>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-stock-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-stock-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/stock/{{($old['stock']??'DESC')}} " class="text-decoration-none" target="{{$old['stock']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault();tables('stock',this.getAttribute('target'),this.getAttribute('old'),document.querySelector('select').value,document.querySelector('input.border').value)">stock</a>
                        </th>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-status-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-status-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/status/{{($old['status']??'DESC')}}" class="text-decoration-none" target="{{$old['status']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault();tables('status',this.getAttribute('target'),this.getAttribute('old'),document.querySelector('select').value,document.querySelector('input.border').value)">status</a>
                        </th>
                        <th scope="col"><a class="text-decoration-none">action</a></th>
                    </tr>
                    </thead>
                    <tbody>
                @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{$product->name}}</th>
                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->status}}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{route('admin.product.edit',['product' => $product->id])}} " class="btn btn-primary">edit</a>
                                <a href="#{{$product->id}}" class="btn btn-danger" onclick="event.preventDefault();confi('deletepost'+{{$product->id}});">delete</a>
                                {!! Form::open(['action'=>['Admin\ProductController@destroy',$product->id],'method'=>'POST','id'=>'deletepost'.$product->id]) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::close() !!}
                                @if($product->status=='out' || $product->stock<=10)
                                    <a href="" class="btn btn-secondary fill" onclick="event.preventDefault();document.querySelector('.d-none').classList.remove('d-none');this.classList.add('d-none')">fillup</a>
                                    {!! Form::open(['action'=>['Admin\ProductController@fillup',$product->id],'method'=>'POST','class'=>'d-none']) !!}
                                        {!! Form::number('stock', '', ['min'=>'11','max'=>'1000']) !!}
                                        {!! Form::submit('confirm',['class'=>'btn btn-warning']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                <div class="d-flex justify-content-center py-4">
                    {!!$products->links()!!}
                </div>
            </div>
            @else
            <a class="btn btn-success" href="{{route('admin.product.create')}} ">add new product</a>
            <div class="table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-name-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-name-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/name/{{($old['name']??'DESC')}}" class="text-decoration-none" target="{{$old['name']??'DESC'}}"  old="{{key($old)??''}}" onclick="event.preventDefault()">name</a>
                        </th>
                        <th scope="col">
                            <i class="d-none bi bi-caret-down-fill ico-title-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-title-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/title/{{($old['title']??'DESC')}}" class="text-decoration-none" target="{{$old['title']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault();">categorie</a>
                        </th>
                        <th scope="col"><i class="d-none bi bi-caret-down-fill ico-price-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-price-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/price/{{($old['price']??'DESC')}}" class="text-decoration-none" target="{{$old['price']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault()">price</a>
                        </th>
                        <th scope="col"><i class="d-none bi bi-caret-down-fill ico-stock-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-stock-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/stock/{{($old['stock']??'DESC')}} " class="text-decoration-none" target="{{$old['stock']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault()">stock</a>
                        </th>
                        <th scope="col"><i class="d-none bi bi-caret-down-fill ico-status-ASC ico-arrow-down"></i>
                            <i target="" class="d-none bi bi-caret-up-fill ico-status-DESC ico-arrow-up"></i>
                            <a href="/admin/tri/status/{{($old['status']??'DESC')}}" class="text-decoration-none" target="{{$old['status']??'DESC'}} " old="{{key($old)??''}}" onclick="event.preventDefault()">status</a>
                        </th>
                        <th scope="col"><a class="text-decoration-none">action</a></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            @endif   
    </div>
@endsection


   
  