<!-- Modal -->
@php
    $j=0;
@endphp
@include('user.inc.payment')
<div class="modal fade" id="ModalDetails{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                              @for ($i = 0; $i < count($images); $i++)
                                @if($images[$i]->product_id==$product->id)
                              <li data-target="#carouselExampleIndicators" data-slide-to="{{$j}}" class="{{($j==0)?'active':''}}"></li>
                               @php
                                   $j++;
                               @endphp
                                @endif
                              @endfor
                            </ol>
                            <div class="carousel-inner">
                                @php
                                  $j=0;    
                                  @endphp
                                @for ($i = 0; $i < count($images); $i++)
                                @if($images[$i]->product_id==$product->id)
                                  <div class="carousel-item {{($j==0)?'active':''}}">
                                    <img class="d-block w-100 h-100" src="/image/{{!empty($images[$i]->name) ? $images[$i]->name:'photo.jpg'}}"  height="250px">
                                  </div>
                                  @php
                                  $j++;    
                                  @endphp
                                @endif
                              @endfor
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                                </button>
                          </div>
                    </div>



                    <div class="col-lg-6 col-md-6 col-sm-12 ">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                <h5 class="float-start">{{$product->name}}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <small class="text-secondary float-start">{{$product->title}}</small>
                            </div>

                        </div>
                        <div class="row py-3">
                            <div class="col-8">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <p class="d-inline">(100 viewers)</p>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                <p class="d-inline">{{$product->stock}} </p>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <h4 class="float-start">$ {{$product->price}}</h4>
                                <p class="my-5">{!!$product->desc!!}.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ">
                                <p>Size</p>
                                <select class="form-select border border-dark rounded-0 " aria-label="Default select example">
                                    <option selected>S</option>
                                    <option value="1">M</option>
                                    <option value="2">L</option>
                                    <option value="3">XL</option>
                                </select>
                            </div>
                            <div class="col">
                                <p>Color</p>
                                <select class="form-select border border-dark rounded-0" aria-label="Default select example">
                                    <option selected>Black</option>
                                    <option value="1">Blue</option>
                                    <option value="2">Red</option>
                                    <option value="3">White</option>
                                </select>
                            </div>
                        </div>
                        <div class="col py-3">
                            <div class="row">
                                @if($product->stock<=10)
                                    <small class="text-danger">only {{$product->stock}} left</small>
                                    <select name="stock" class="form-select" id="nbr{{$product->id}}" onchange="document.querySelector('#total_pay{{$product->id}}').textContent='pay '+parseInt({{$product->price}})*this.value +'$'">
                                        @for ($i = 0; $i < $product->stock; $i++)
                                            <option value="{{$i+1}}">{{$i+1 }}</option>            
                                        @endfor
                                    </select>
                                    @else
                                    <select name="stock" class="form-select" id="nbr{{$product->id}}" onchange="document.querySelector('#total_pay{{$product->id}}').textContent='pay '+parseInt({{$product->price}})*this.value +'$'">
                                        @for ($i = 0; $i < floor($product->stock*0.45); $i++)
                                            <option value="{{$i+1}}">{{$i+1 }}</option>            
                                        @endfor
                                    </select>
                                    @endif
                                <div class="col-4">
                                    <button class="btn btn-success my-2 w-100" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$product->id}}" onclick="event.preventDefault()">buy</button>
                                </div>
                            </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script>
   $(function (id) {
    var $form = $(".stripe-payment{{$product->id}}");
    $('form.stripe-payment{{$product->id}}').bind('submit', function (e) {
        var $form = $(".stripe-payment{{$product->id}}"),
            inputVal = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputVal),
            $errorStatus = $form.find('div.d-none'),
            valid = true;
        $errorStatus.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function (i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorStatus.removeClass('d-none');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-num').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeRes);
        }

    });

    function stripeRes(status, response) {
        if (response.error) {
            $('d-none').removeClass('d-none')
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});


</script>