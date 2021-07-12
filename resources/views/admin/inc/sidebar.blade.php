<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{(explode('/',Route::current()->uri)[1]=='dashboard')?'active':''}} " aria-current="page" href="{{route('admin.home')}} ">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(explode('/',Route::current()->uri)[1]=='buy')?'active':''}}" href="{{route('admin.buy.index')}} " >
            <span data-feather="file"></span>
            Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(explode('/',Route::current()->uri)[1]=='product')?'active':''}}" href="{{route('admin.product.index')}} " >
            <span data-feather="shopping-cart"></span>
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(explode('/',Route::current()->uri)[1]=='categorie')?'active':''}}" aria-current="page" href="{{route('admin.categorie.index')}} ">
            <span data-feather="list"></span>
            categories
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(explode('/',Route::current()->uri)[1]=='user')?'active':''}}" href="{{route('admin.user.index')}} " >
            <span data-feather="users"></span>
            Customers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(explode('/',Route::current()->uri)[1]=='raport')?'active':''}}" href="#">
            <span data-feather="bar-chart-2"></span>
            Reports
          </a>
        </li>
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Current month
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Last quarter
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Social engagement
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Year-end sale
          </a>
        </li>
      </ul>
    </div>
  </nav>
      
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      @guest
            @if (Route::has('admin.login'))
                <a href="{{route('admin.login')}}" class="btn btn-outline-light me-2">{{__('login')}}</a>
            @endif
            @if (Route::has('admin.register'))
                <a href="{{route('admin.register')}}" class="btn btn-warning">{{__('register')}}</a>
            @endif
              
            @else
          <a class="btn btn-warning" href="{{ route('admin.logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>
                    {!! Form::open(['action'=>'Admin\\Auth\\LoginController@logout','method'=>'POST','id'=>'logout-form']) !!}
                    {!! Form::close() !!}
            @endguest
    </li>
  </ul>
</header>

<div class="container">
  <div class="row">
    