<div class="modal fade" id="staticBackdrop{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row copy">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (Session::has('success'))
                        <div class="alert alert-primary text-center">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        @if (!isset($card))
                            <div class="alert alert-secondary">NOTE: you can register your card in the personnal information in profile</div>
                        @endif
                        <form role="form" action="{{ route('make-payment',['product'=>$product->slug]) }}" method="post" class="stripe-payment{{$product->id}}"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="stripe-payment{{$product->id}}">
                            @csrf
                            <div class='form-row row '>
                                  <div class='col-xs-12 d-none hide error form-group'>
                                      <div class='alert-danger alert'></div>
                                  </div>
                            </div>
                            <div class='form-row row'>
                              
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> 
                                    <input class='form-control' size='4' value="{{($card->card_name??'')}}" type='text'>
                                </div>
                            </div>
              
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group card required'>
                                    <label class='control-label'>Card Number</label> <input autocomplete='off'
                                        class='form-control card-num' value="{{($card->card_number??'')}}" size='20' type='text'>
                                </div>
                            </div>
              
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595' size='4' type='text' value="{{($card->card_cvc??'')}}">
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> <input
                                        class='form-control card-expiry-month' value="{{($card->card_exp_mm)??''}}" placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' value="{{($card->card_exp_yy)??''}}" size='4' type='text'>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-success btn-lg btn-block" id="total_pay{{$product->id}}"  type="submit">Pay {{$product->price.'$'}}</button>
                            </div>
                    </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>