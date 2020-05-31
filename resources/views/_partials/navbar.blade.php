
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="{{ asset('assets/img/logo-dark.png') }}" alt="" height="40px" width="150px"/>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li style="padding-left: 20px" class="{{ (request()->segment(1) === 'home') ? 'active' : '' }}">
{{--                <a href="{{url('/home')}}" class="active">--}}
                <a class="nav-link" href="{{url('/home')}}">Product <span class="sr-only">(current)</span></a>
            </li>
            @can('categories-page')
            <li style="padding-left: 20px" class="{{ (request()->segment(1) === 'category') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('categories.view')}}">Categories <span class="sr-only">(current)</span></a>
            </li>
            @endcan

            @can('users-page')
            <li  class="{{ (request()->segment(1) === 'users') ? 'active' : '' }}">
                <a class="nav-link "  href="{{route('users.view')}}" >
                    Users
                </a>
               {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">All Users</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="">Add User</a>
                </div>--}}
            </li>
            @endcan
        </ul>

        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item dropdown dropdown-slide" style="margin-right:30px;">
                <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/img/user.png') }}" alt="John Doe">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
                    <div class="dropdown-header pb-3">
                        <div class="media d-user">
                            <img class="align-self-center mr-3" src="{{ asset('assets/img/user.png') }}" alt="John Doe" height="50px" width="50px">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">{{ auth()->user()->name }}</h5>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>


                    <a class="dropdown-item" href="{{route('change_password')}}"><i class=" ti-lock"></i> Change Password</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class=" ti-unlock"></i>        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </div>
            </li>

        </ul>
{{--        <form class="form-inline my-2 my-lg-0">--}}
{{--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
{{--        </form>--}}
    </div>
</nav>
