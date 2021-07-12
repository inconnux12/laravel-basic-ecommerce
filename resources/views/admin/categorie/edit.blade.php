@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['action'=>['Admin\CategorieController@update',$categorie->id],'method'=>'POST']) !!}
    <div class="form-group">
        {!! Form::label('title', 'title',['class'=>'formGroupExampleInput']) !!}
        {!! Form::text('title',$categorie->title,['class'=>'form-control ']) !!}
        {!! Form::submit('confirm',['class'=>'btn btn-warning']) !!}
        {!! Form::hidden('_method', 'put') !!}
    </div>
    {!! Form::close() !!}
@endsection