@extends('user.layouts.app')
@section('content')
@include('user.inc.payment')
<div class="row">
    <div class="col-md-6" style="height:30rem">
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
    <div class="col-md-6">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">{!!$product->desc!!} </p>
            @if($product->unit->stock<=10)
              <small class="text-danger">only {{$product->unit->stock}} left</small>
              <select name="stock" class="form-select" id="nbr" onchange="document.querySelector('#total_pay').textContent='pay '+parseInt({{$product->price}})*this.value +'$'">
                  @for ($i = 0; $i < $product->unit->stock; $i++)
                      <option value="{{$i+1}}">{{$i+1 }}</option>            
                  @endfor
              </select>
            @else
              <select name="stock" class="form-select" id="nbr" onchange="document.querySelector('#total_pay').textContent='pay '+parseInt({{$product->price}})*this.value +'$'">
                @for ($i = 0; $i < floor($product->unit->stock*0.45); $i++)
                    <option value="{{$i+1}}">{{$i+1 }}</option>            
                @endfor
            </select>
            @endif
            <button class="btn btn-success my-2 w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="event.preventDefault()">buy</button>
            </form>
            </div>
        </div>
    </div> 
</div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{asset('js/stripe.js')}} "></script> 
<script>
    function loading()
    {
        var dialog = bootbox.dialog({
            title: 'A custom dialog with init',
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
        });
                    
        dialog.init(function(){
            setTimeout(function(){
                dialog.modal('hide');
            }, 3300);
        });
    }
</script>
@endsection