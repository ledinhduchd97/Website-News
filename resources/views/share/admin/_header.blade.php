<!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('admin.index')}}">Tin Tức Admin</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive" style="height: auto">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('admin.index')}}">
            <i class="fas fa-tachometer-alt"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="{{route('theloai.index')}}">
            <i class="fas fa-book-open"></i>
            <span class="nav-link-text">Quản Lí Thể Loại</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="{{route('loaitin.index')}}">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Quản Lí Loại Tin</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="{{route('user.index')}}">
            <i class="fas fa-user"></i>
            <span class="nav-link-text">Quản Lí Tài Khoản</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="{{route('slide.index')}}">
            <i class="far fa-image"></i>
            <span class="nav-link-text">Quản Lí Slide</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="far fa-newspaper"></i>
            <span class="nav-link-text">Quản Lí Tin Tức</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages" style="height: auto">
            <li>
              <a href="{{route('tintuc.get.postnew')}}">Đăng Tin</a>
            </li>
            <li>
              <a href="{{route('tintuc.index.public')}}">Tin tức đã đăng</a>
            </li>
            <li>
              <a href="{{route('tintuc.index.private')}}">Tin đang đợi duyệt</a>
            </li>
            <li>
              <a href="{{route('tintuc.getview.hotnews')}}">Quản lý tin nóng</a>
            </li>
            <li>
              <a href="{{route('tintuc.getview.highlightnews')}}">Quản lý tin nổi bật</a>
            </li>
<!--             <li>
              <a href="forgot-password.html">Forgot Password Page</a>
            </li>
            <li>
              <a href="blank.html">Blank Page</a>
            </li> -->
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="get.logout">
            <i class="fas fa-sign-out-alt"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>