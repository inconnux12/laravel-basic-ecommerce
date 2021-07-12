{!! Form::open(['action'=>'BuyController@store','method'=>'POST']) !!}  
<div class="col-12">
  <label for="address" class="form-label">Address</label>
  <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
</div>
<div class="d-flex">
  <div class="col-md-5">
    <label for="country" class="form-label">willaya</label>
    <select class="form-select" id="country" name="willaya" onchange="cities(this.value)" required>
      <option value="0">willaya</option>
      @foreach ($willayas as$key=>$willaya)
        <option value="{{$key}}">{{$willaya}}</option>    
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label for="state" class="form-label">city</label>
    <select class="form-select" name="ville" id="state" required>
      <option value="">Choose...</option>
    </select>
  </div>

  <div class="col-md-3">
    <label for="zip" class="form-label">Zip</label>
    <input type="text" name="zip_code" class="form-control" id="zip" placeholder="" required>
  </div>
</div>
<hr class="my-4">
<h4 class="mb-3">Payment</h4>
<div class="row gy-3">
  <div class="col-md-6">
    <label for="cc-name" class="form-label">Name on card</label>
    <input type="text" name="card_name" class="form-control" id="cc-name" placeholder="" required>
  </div>

  <div class="col-md-6">
    <label for="cc-number" class="form-label">Credit card number</label>
    <input type="text" name="card_number" class="form-control" id="cc-number" placeholder="" required>
  </div>

  <div class="col-md-3">
    <label for="cc-expiration" class="form-label">Expiration</label>
      <input type="text" name="card_exp_mm" class="form-control" id="cc-expiration" placeholder="MM" required>
      <input type="text" name="card_exp_yy" class="form-control" id="cc-expiration" placeholder="YYYY" required>
  </div>

  <div class="col-md-3">
    <label for="cc-cvv" class="form-label">CVV</label>
    <input type="text" name="card_cvc" class="form-control" id="cc-cvv" placeholder="" required>
  </div>
</div>
<hr class="my-4">
<button class="w-100 btn btn-primary btn-lg" type="submit">save</button>
{!! Form::close() !!}   
