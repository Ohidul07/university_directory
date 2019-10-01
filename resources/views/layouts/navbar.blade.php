<nav class="navbar navbar-top bg-purple navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h5 mb-0 text-white d-none d-lg-inline-block" href="#">@yield('header')</a>
        <!-- Form -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ url('assets/img/theme/image.png') }}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="#" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Change Password</span>
              </a>
              <div class="dropdown-divider"></div>
              <form method="post" action="/logout">
                @csrf
                <button type="submit" class="dropdown-item logout-btn"><i class="ni ni-user-run"></i><span>Logout</span></button>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>