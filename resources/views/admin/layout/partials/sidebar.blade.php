<div class="menu-mobile menu-activated-on-click color-scheme-dark">
    <div class="mm-logo-buttons-w"><a class="mm-logo" href="#"><img src="{{asset('assets/img/logo.png')}}"><span>Clean Admin</span></a>
        <div class="mm-buttons">
            <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
            </div>
            <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
        </div>
    </div>
    <div class="menu-and-user">
        <div class="logged-user-w">
            <div class="avatar-w"><img alt="" src="{{asset('assets\img\avatar1.jpg')}}"></div>
            <div class="logged-user-info-w">
                <div class="logged-user-name">{{Auth::user()->first_name}}</div>
                <div class="logged-user-role">Administrator</div>
            </div>
        </div>


        <!--------------------
START - Mobile Menu List
-------------------->
        <ul class="main-menu">
            <li class="has-sub-menu"><a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-window-content"></div>
                    </div>
                    <span>Dashboard</span></a></li>
            <li class="has-sub-menu"><a href="{{route('committees.index')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-window-content"></div>
                    </div>
                    <span>Committee</span></a>
            </li>
            <li class="has-sub-menu"><a href="{{route('members.index')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-window-content"></div>
                    </div>
                    <span>Member</span></a>
            </li>

        </ul>
        <
    </div>
</div><!--------------------
END - Mobile Menu
--------------------><!--------------------
-------------------->
<div class="desktop-menu menu-side-w menu-activated-on-click">
    <div class="menu-and-user">
        <div class="logged-user-w">
            <div class="logged-user-i">
                <div class="avatar-w"><img alt="" src="{{asset('assets/img/avatar1.jpg')}}"></div>
                <div class="logged-user-info-w">
                    <div class="logged-user-name">{{Auth::user()->full_name}}</div>
                    <div class="logged-user-role">Administrator</div>
                </div>
                <div class="logged-user-menu">
                    <div class="logged-user-avatar-info">
                        <div class="avatar-w"><img alt="" src="{{asset('assets/img/avatar1.jpg')}}"></div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name">{{Auth::user()->full_name}}</div>

                            <div class="logged-user-role">Administrator</div>
                        </div>
                    </div>
                    <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                    <ul>
                        <li><a href="#"><i
                                        class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a></li>
                        <li><a href="#"><i
                                        class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                        </li>
                        <li><a href="#"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a>
                        </li>
                        <li><a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                        </li>
                        <li>
                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                <i class=" os-icon os-icon-signs-11"></i>
                                <span>
                                    {{ __('Logout') }}
                                </span>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="main-menu">
            <li class=""><a href="{{url('/')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-home-34"></div>
                    </div>
                    <span>Dashboard</span></a>
            </li>
            <li class=""><a href="{{route('committees.index')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-delivery-box-2"></div>
                    </div>
                    <span>Committee</span></a>
            </li>
            <li class=""><a href="{{route('members.index')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-user-male-circle"></div>
                    </div>
                    <span>Member</span></a>
            </li>
            <li class=""><a href="{{route('committee-reports.index')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-documents-11"></div>
                    </div>
                    <span>Report</span></a>
            </li>

        </ul>
    </div>
</div><!--------------------
END - Menu side
-------------------->