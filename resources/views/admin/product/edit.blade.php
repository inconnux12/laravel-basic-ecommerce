@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['action'=>['Admin\ProductController@update',$product->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {!! Form::label('name', 'name',['class'=>'formGroupExampleInput']) !!}
        {!! Form::text('name',$product->name,['class'=>'form-control ']) !!}
        {!! Form::label('categorie','categorie',['class'=>'formGroupExampleInput']) !!}
        <select name="categorie" id="" class="form-select">
            @foreach ($categories as $categorie)
                <option value="{{$categorie->id}}" {{($product->categorie_id==$categorie->id)?'selected':''}}>{{$categorie->title}}</option>
            @endforeach
        </select>
        {!! Form::label('desc','desc',['class'=>'formGroupExampleInput']) !!}
        {!! Form::textarea('desc',$product->desc,['class'=>'form-control ','id'=>'article-ckeditor']) !!}
        <div class="input-group mb-3">
            {!! Form::label('price','price',['class'=>'formGroupExampleInput']) !!}
            {!! Form::number('price', $product->price, ['step'=>'0.01','class'=>'form-control']) !!}
            <span class="input-group-text">$</span>
        </div>
        {!! Form::label('stock','stock',['class'=>'formGroupExampleInput']) !!}
        {!! Form::number('stock', $product->unit->stock, ['step'=>'0.01','min'=>'10','max'=>'1000']) !!}
        {!! Form::label('image','image',['class'=>'formGroupExampleInput']) !!}
        {!! Form::file('image[]', ['class'=>'form-control md-3','multiple'=>'multiple']) !!}
        {!! Form::submit('confirm',['class'=>'btn btn-warning']) !!}
        {!! Form::hidden('_method', 'PUT') !!}
    </div>
    {!! Form::close() !!}
@endsection