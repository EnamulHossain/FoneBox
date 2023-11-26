<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
    <style>
      .nav-link {
          font-size: 1.2rem;
      }
      .navbar-nav .nav-link.active, .navbar-nav .nav-link.show {
          color: purple;
          font-weight:bold;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"> <a class="nav-link " href="{{url('/')}}">Home</a> </li>
            <li class="nav-item"> <a class="nav-link {{'dashboard'==request()->path()?'active':''}}"  href="{{url('dashboard')}}">Dashboard</a> </li>
            
            @can('role-list')<li class="nav-item"> <a class="nav-link {{'roles'==request()->path()?'active':''}}" href="{{route('roles.index')}}">Roles</a> </li>@endcan
            @can('permission-list')<li class="nav-item"> <a class="nav-link {{'permissions'==request()->path()?'active':''}}" href="{{route('permissions.index')}}">Permissions</a> </li>@endcan
            @can('user-list')
            <li class="nav-item"> <a class="nav-link {{'users'==request()->path()?'active':''}} {{'users/create'==request()->path()?'active':''}}" href="{{route('users.index')}}">Users</a> </li>
            @endcan
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                </li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    @yield('content')
    @yield('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>