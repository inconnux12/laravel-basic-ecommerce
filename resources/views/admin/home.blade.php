
@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                  you are admin
                  <a href="{{route('admin.contact')}}" class="btn btn-primary">contact</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
