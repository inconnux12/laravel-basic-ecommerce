@extends('admin.layouts.app')
@section('content')
@if (!count($buys)>0)
<div class="jumbotron text-center">
    <h3 class="display-3">their no new buyed products</h3>
    <p class="">there is no buyed products to approve</p>
</div>
@else  
<table class="table table-bordered mb-5">
        <thead>
            <tr class="table-success">
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-id-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-id-down ico-arrow-up"></i><a target="{{$other['id']??'down'}}" href="/posts/tri/id/{{$other['id']??'down'}}" onclick="event.preventDefault();order('id',this.getAttribute('target'));">user name</a></th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-title-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-title-down ico-arrow-up"></i><a target="{{$other['title']??'down'}}" href="/posts/tri/title/{{$other['title']??'down'}} "onclick="event.preventDefault();order('title',this.getAttribute('target'));">product name</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">date of buy</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">Qnt</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">total prices</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">status</th>
                <th scope="col">approve</th>  
                
            </tr>
        </thead>
        <tbody>
            @foreach ($buys as $buy)      
                <tr>
                    <th scope="row">{{$buy->user_name}} </th>
                    <td>{{$buy->product_name}}</td>
                    <td>{{ $buy->created_at}}</td>
                    <td>{{ $buy->nbr_purchases}}</td>
                    <td>{{ $buy->total}}</td>
                    <td>{{ $buy->status}}</td>
                    <td>
                    {!! Form::open(['action'=>['Admin\BuyController@approve',$buy->id],'method'=>'POST']) !!}
                        {!! Form::submit('approve', ['class'=>'btn btn-success']) !!}
                    {!! Form::close() !!}
                    </td>     
                </tr> 
            @endforeach
        </tbody>
</table>
<div class="d-flex justify-content-center py-4">
{!!$buys->links()!!}
</div>
@endif
@endsection