<nav class="navbar navbar-expand-lg shadow-sm" data-bs-theme="light">
  <div class="container d-flex flex-row justify-content-between align-middle">
    <a class="navbar-brand" href="{{url('/')}}">
      <img height="50" width="50" src="images/delivery.png" alt="#" />
    </a>
      <div class="navbar-nav">
         <a class="nav-link" href="{{url('show_cart')}}">Cart</a>
         @if (Route::has('login'))
            @auth
            <x-app-layout></x-app-layout>
         @else
            <a class="nav-link" href="{{ route('login') }}" id="logincss">Login</a>
            <a class="nav-link" href="{{ route('register') }}">Register</a>
            <form class="d-flex ms-1" role="search">
               <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
               <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
            </form>
            @endauth
         @endif
      </div>
  </div>
</nav>