{{-- <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('home')}}">
        <img src="{{asset('images/site/logo.png')}}" class="css-class" alt="alt text">
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav> --}}
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand float-left" href="{{url('home')}}">
            <img src="{{asset('images/site/logo.png')}}" class="css-class" alt="alt text">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNavDropdown" style="">
            <ul class="navbar-nav ml-auto">
                @if(!Auth::guest())
                <li class="nav-item dropdown pr-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mijn Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="">Instellingen</a>
                        <a class="dropdown-item" href="">Bestellingen</a>
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown dropdown-cart pr-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-basket"></i> Cart
                    </a>
                    <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                        <headercart :cart="{{$cart}}" :amounttotal="{{$cart_amount}}" />
                    </div>
                </li>
                @if(!Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin')}}">Admin</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('login')}}">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
