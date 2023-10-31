<header class="main-header">

    <a @if(Session::has('loginId')) href="{{url('IIN/dashboard')}}" @endif class="logo">

        <span class="logo-mini"><img src="{{asset('admin_assets/dist/img/FlashAlert-Icon.png')}}"><b>Admin</b></span>

        <span class="logo-lg text-left"><img src="{{asset('admin_assets/dist/img/FlashAlert-Icon.png')}}"><b>Flash Alert</b></span>

    </a>

    <nav class="navbar navbar-static-top">
@if(Session::has('loginId'))
        <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
@endif
            <span class="sr-only">Toggle navigation</span>

        </a>

        {{-- <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">

                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">

                        <img src="{{asset('admin_assets/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">

                        <span class="hidden-xs"> {{ $data[0]->UserName }}</span>

                    </a>

                    <ul class="dropdown-menu">

                        <li class="user-header">

                            <img src="{{asset('admin_assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                            <p>

                                {{ $data[0]->PrimaryWorkEmail }}
                            </p>

                        </li>

                        <li class="user-body">

                        </li>

                        <li class="user-footer">

                            <div class="pull-left">

                                <a href="javascript:void(0)" class="btn btn-default btn-flat">Profile</a>

                            </div>

                            <div class="pull-right">

                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>

                            </div>

                        </li>

                    </ul>

                </li>

            </ul>

        </div> --}}

    </nav>

</header>