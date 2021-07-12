 <header class="topbar bg-transparent">
    <div class="container-fluid my-2 ">
        <div class="row ">
            <div class="col-3 d-lg-inline  d-none mx-2 logo">
                <a href="{{route('home')}}"><h5>My Eshop.</h5></a>
                <small>It's never been so easy </small>
            </div>
            <div class="col-5 offset-1 d-lg-inline  d-none py-2">
                <form action="{{isset($current_prefix)?route('categorie.show',['categorie'=>$current_cat]):route('home')}} " class="d-inline-block col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="GET">  
                  <div class="input-group mb-3"> 
                    @if (!isset($current_prefix))
                      <select class="form-select btn btn-outline-secondary " name="categorie">
                        <option value="all">All</option>
                        @foreach ($categories as $categorie)
                          <option value="{{$categorie->slug}}">{{$categorie->title}}</option>
                        @endforeach
                      </select>
                    @endif 
                      <div class="input-group-append">
                        <input type="search" name="q" class="form-control btn-outline-secondary" placeholder="Search Article Here..." aria-describedby="button-addon2" placeholder="Search...">
                      </div>
                  </div>
              </form>
            </div>


            <div class="col py-2 d-lg-inline ">
                @guest
                @if (Route::has('login'))
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalLogin">
                   <i title="Login" class="fa fa-sign-in-alt "></i> {{__('login')}} 
                </button>
                @endif
                @if (Route::has('register'))
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalRegister">
                  <i title="Register" class="fa fa-user-alt "></i> {{__('register')}}
              </button>    
               
                @endif
                
                @else
              {{-- <a class="dropdown-item btn btn-warning" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                              {{ __('Logout') }}
                                          </a> --}}
                        {!! Form::open(['action'=>'Auth\\LoginController@logout','method'=>'POST','id'=>'logout-form']) !!}
                       <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-out-alt"></i>  {{__('lougout')}}
                       </button>
                        {!! Form::close() !!}
                @endguest
            </div>
        </div>
    </div>
</header>

<section class="tab bg-dark py-2 ">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container-fluid">
                    <h4 class="navbar-brand d-lg-none d-block" href="{{route('home')}} ">My Eshop.</h4>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-light" aria-current="page" href="{{route('home')}} ">Home</a>
                            </li>
                            @guest
                            @else
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{route('profile')}}">profile</a>
                            </li>
                            @endguest
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</section>
{{----------------------------------------------!carousel-------------------------------------------------------------------------------------------------------------}}
<div id="slides" class="carousel  slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slides" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#slides" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#slides" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('images/jorge.jpg')}}" class="d-block w-100 " alt="kk">
            <div class="carousel-caption d-block ">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('images/chooseclotheevencovid.jpg')}}" class="d-block w-100" alt="choose">
            <div class="carousel-caption d-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('images/hold-bags.jpg')}}" class="d-block w-100" alt="bags">
            <div class="carousel-caption d-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slides" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slides" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
