<nav class="navbar navbar-expand-lg nvbar-dark bg-dark">
  <div class="container">

    <a href="{{route('home')}}" class="navbar-brand">My Blog</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{route('about')}}" class="nav-link">About</a>
        </li>
        <li class="nav-item">
          <a href="{{route('contact')}}" class="nav-link">Contact</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        @guest
          <li class="nav-item">
              <a href=" {{route('login')}} " class="nav-link">Login</a>
          </li>
          <li class="nav-item">
              <a href=" {{route('register')}} " class="nav-link">Register</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href=" {{route('dashboard')}} ">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expand="false">
              {{Auth::user()->name}} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action=" {{route('logout')}} " method="POST" style="display:none;">@csrf</form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>