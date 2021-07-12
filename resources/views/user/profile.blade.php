@extends('user.layouts.app')
@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">personnal information</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">recent buy</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">already delivered</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    @if ($user->card_id)
    @include('user.inc.editpayment')  
  @else
    @include('user.inc.fillpayment')
  @endif
  </div>  
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    @if (!count($buys)>0)
    <div class="jumbotron text-center">
        <h3 class="display-3">your buyed products</h3>
        <p class="">there is no products</p>
    </div>
    @else
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-success">
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-id-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-id-down ico-arrow-up"></i><a target="{{$other['id']??'down'}}" href="/posts/tri/id/{{$other['id']??'down'}}" onclick="event.preventDefault();order('id',this.getAttribute('target'));">#</a></th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-title-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-title-down ico-arrow-up"></i><a target="{{$other['title']??'down'}}" href="/posts/tri/title/{{$other['title']??'down'}} "onclick="event.preventDefault();order('title',this.getAttribute('target'));">product name</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">date of buy</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">Qnt</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">total prices</th>
                <th scope="col"><i class="d-none bi bi-caret-down-fill ico-created_at-up ico-arrow-down"></i><i target="" class="d-none bi bi-caret-up-fill ico-created_at-down ico-arrow-up"></i><a target="{{$other['created_at']??'down'}}" href="/posts/tri/created_at/{{$other['created_at']??'down'}}"onclick="event.preventDefault();order('created_at',this.getAttribute('target'));">status</th>
                <th scope="col">cancel</th>  
                
            </tr>
        </thead>
        <tbody>
            @foreach ($buys as $buy)
            <tr>
                <th scope="row">#</th>
                <td><a href="{{route('product.show',['product' => $buy->slug])}}">{{$buy->name}}</a></td>
                <td>{{ $buy->created_at}}</td>
                <td>{{ $buy->nbr_purchases}}</td>
                <td>{{ $buy->total}}</td>
                <td>{{ $buy->status}}</td>
                <td> 
                    @if ($buy->status=='wait')
                    <a href="#{{$buy->id}}" class="btn btn-danger" onclick="event.preventDefault();confi('deletepost'+{{$buy->id}});">delete</a>
                    {!! Form::open(['action'=>['BuyController@destroy',$buy->id],'method'=>'POST','id'=>'deletepost'.$buy->id]) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        
                    {!! Form::close() !!}
                    @else
                    <p>your command has been approved you can't cancel it</p>
                @endif
                </td>    
            </tr> 
            @endforeach
        </tbody>
</table>
<div class="d-flex justify-content-center py-4">
{!!$buys->links()!!}
</div>
@endif

  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="jumbotron text-center">
        <h3 class="display-3">your delivred products</h3>
        <p class="">there is no products</p>
    </div>
  </div>
</div>  
<script>
  function cities(id){
    fetch('willaya.json')
    .then(res=>res.json())
    .then(data=>{
      let i=1
      let prev=1
      let talb=Array()
      for(const willaya of data){
        if(willaya.wilaya_code==i){
          let vil=new Object()
          vil['willaya']=willaya.wilaya_name
          vil['commune']=new Array(willaya.commune_name) 
          talb[i]=vil
          prev=i
          i++
        }
        else if(prev==willaya.wilaya_code){
          talb[prev]['commune'].push(willaya.commune_name)
        }
      }
    return talb
    })
    .then(w=>{
      let select=document.querySelector('#state')
      select.innerHTML=''
      for(const vile of w[id]['commune']){
        let option=document.createElement('option')
        option.value=vile
        option.textContent=vile
        select.appendChild(option)
      }
    })
  }
</script>
@endsection