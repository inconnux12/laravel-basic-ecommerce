{!! Form::open(['action'=>['BuyController@update',$user->card->id],'method'=>'POST','id'=>'form']) !!}  
<div class="col-12">
  <label for="address" class="form-label">Address</label>
  <input type="text" class="form-control" name="address" id="address" value="{{$user->card->address}}" placeholder="1234 Main St" required>
</div>
<div class="d-flex">
  <div class="col-md-5">
    <label for="country" class="form-label">willaya</label>
    <select class="form-select" id="country" name="willaya" onchange="cities(this.value)" required>
      <option value="0">willaya</option>
      @foreach ($willayas as$key=>$willaya)
        <option value="{{$key}}"{{($user->card->willaya_code==$key)?'selected':''}}>{{$willaya}}</option>    
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label for="state" class="form-label">city</label>
    <select class="form-select" name="ville"  id="state" required>
      <option value="{{$user->card->ville}}">{{$user->card->ville}}</option>
    </select>
  </div>

  <div class="col-md-3">
    <label for="zip" class="form-label">Zip</label>
    <input type="text" name="zip_code" value="{{$user->card->zip_code}}" class="form-control" id="zip" placeholder="" required>
  </div>
</div>
<hr class="my-4">
<h4 class="mb-3">Payment</h4>
<div class="row gy-3">
  <div class="col-md-6">
    <label for="cc-name" class="form-label">Name on card</label>
    <input type="text" name="card_name" class="form-control" value="{{$user->card->card_name}}" id="cc-name" placeholder="" required>
  </div>

  <div class="col-md-6">
    <label for="cc-number" class="form-label">Credit card number</label>
    <input type="text" name="card_number" class="form-control" value="{{$user->card->card_number}}" id="cc-number" placeholder="" required>
  </div>

  <div class="col-md-3">
    <label for="cc-expiration" class="form-label">Expiration</label>
      <input type="text" name="card_exp_mm" class="form-control" value="{{$user->card->card_exp_mm}}" id="cc-expiration" placeholder="MM" required>
      <input type="text" name="card_exp_yy" class="form-control" value="{{$user->card->card_exp_yy}}" id="cc-expiration" placeholder="YYYY" required>
  </div>

  <div class="col-md-3">
    <label for="cc-cvv" class="form-label">CVV</label>
    <input type="text" name="card_cvc" class="form-control" value="{{$user->card->card_cvc}}" id="cc-cvv" placeholder="" required>
  </div>
</div>
<hr class="my-4">
<button class="w-100 btn d-none btn-success btn-lg" type="submit">update</button>
{!! Form::hidden('_method', 'PUT') !!}
{!! Form::close() !!}   

<script>
  let from =document.querySelector('form#form')
  inputs=form.elements
  for(i=0;i<inputs.length;i++){
    inputs[i].disabled=true
  }
  inputs[inputs.length-2].classList.add('d-none')
  let btn=document.createElement('button')
  btn.textContent='edit'
  btn.classList="w-100 btn btn-primary btn-lg"
  form.insertAdjacentElement('afterend', btn)
  btn.addEventListener('click',()=>{
    /////////////////////////////////////////
    let cancel=document.createElement('button')
    cancel.classList="w-100 my-2 btn btn-danger btn-lg"
    cancel.textContent="cancel"
    form.insertAdjacentElement('afterend', cancel)
    cancel.addEventListener('click',function(){
      location.reload()
      return false
    })
    ////////////////////////////////////////
    btn.classList.add('d-none')
    btn.textContent="cancel"
    for(i=0;i<inputs.length;i++){
      inputs[i].disabled=false
    }
    inputs[inputs.length-2].classList.remove('d-none')

  })

</script>