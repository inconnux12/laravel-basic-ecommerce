@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['action'=>'Admin\CategorieController@store','method'=>'POST']) !!}
    <div class="form-group">
        {!! Form::label('title', 'title',['class'=>'formGroupExampleInput']) !!}
        {!! Form::text('title','',['class'=>'form-control ']) !!}
        {!! Form::submit('confirm',['class'=>'btn btn-warning']) !!}
    </div>
    {!! Form::close() !!}
@endsection