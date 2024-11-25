<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="{{ route('index') }}"><img class="img-30 rounded-circle"
                        src="{{ asset('2.png') }}" alt="femcas logo"></a></div>
            <div class="dark-logo-wrapper"><a href="{{ route('index') }}"><img class="img-30 rounded-circle"
                        src="{{ asset('2.png') }}" alt="femcas logo"></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>
        </div>

        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>

                <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>
                            <p class="f-w-700 mb-0">You have Notifications<span
                                    class="pull-right badge badge-primary badge-pill">4</span></p>
                        </li>
                        <li class="noti-primary">
                            {{-- <div class="media">
                <span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span>
                <div class="media-body">
                  <p>Delivery processing </p>
                  <span>10 minutes ago</span>
                </div>
              </div> --}}
                        </li>

                    </ul>
                </li>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>

                <li class="onhover-dropdown p-0">
                    <button class="btn btn-primary-light" type="button"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i
                            data-feather="log-out"></i>Log out</button>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
