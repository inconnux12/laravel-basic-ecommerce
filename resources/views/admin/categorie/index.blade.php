@extends('admin.Layouts.app')
@section('content')
    <div class="row">
            @if (count($categories)>0)
            <div class="d-flex justify-content-between">
                <a class="btn btn-success" href="{{route('admin.categorie.create')}} ">add new categorie</a>
                <form action="{{route('admin.categorie.index')}} " class="d-inline-block col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="GET">  
                    <div class="input-group mb-3"> 
                        <div class="input-group-append">
                          <input type="search" name="q" class=" border border-secondary form-control form-control-dark" placeholder="Search...">
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">title</th>
                    <th scope="col">number of products</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)  
                    <tr>
                        <th scope="row">{{$categorie->title}}</th>
                        <td>{{count($categorie->products)}}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{route('admin.categorie.edit',['categorie' => $categorie->id])}} " class="btn btn-primary">edit</a>
                            <a href="#{{$categorie->id}}" class="btn btn-danger" onclick="event.preventDefault();confi('deletepost'+{{$categorie->id}});">delete</a>
                            {!! Form::open(['action'=>['Admin\CategorieController@destroy',$categorie->id],'method'=>'POST','id'=>'deletepost'.$categorie->id]) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
            <div class="d-flex justify-content-center py-4">
                {!!$categories->links()!!}
            </div>
            @else
            <a class="btn btn-success" href="{{route('admin.categorie.create')}} ">add new categorie</a>
            @endif   
    </div>
@endsection


   
  