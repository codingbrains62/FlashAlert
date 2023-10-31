<style>
    aside.main-sidebar{
    width: 235px;
}
</style>
<aside class="main-sidebar">
    <section class="sidebar" style="font-weight: 389">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin_assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $data[0]->UserName }}</p>
                <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN MENU</li>
            <li class="{{ in_array(Route::currentRouteName(), ['backend.dashboard']) ? 'active' : '' }}">
                <a href="{{ route('backend.dashboard') }}"><span>Dashboard</span>
                </a>
            </li>
            @if ($data[0]->SecurityLevel == 3)
                <li
                    class="treeview always-open {{ in_array(Route::currentRouteName(), ['f.login', 'msg.dispatch', 'email.address', 'quick.signup', 'subs.dis.status', 'add.newuser', 'region.data', 'city.data', 'org.data', 'autoconfirmemail', 'QReport', 'style.templates', 'psub_list', 'purg_subs', 'email.changeTool']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="fw-bold"><span>Global Administration</span>
                        <span class="pull-right-container" id="globalAdminToggle">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu cst-opn-menu">
                        <li
                            class="treeview {{ in_array(Route::currentRouteName(), ['f.login', 'msg.dispatch', 'email.address', 'quick.signup', 'subs.dis.status', 'add.newuser']) ? 'active' : '' }}">
                            <a href="javascript:void(0)"> Tools & Reports
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ in_array(Route::currentRouteName(), ['f.login']) ? 'active' : '' }}"><a
                                        href="{{ route('f.login') }}" class="side-txt-blu">Failed Logins</a></li>
                                <li class="{{ in_array(Route::currentRouteName(), ['msg.dispatch']) ? 'active' : '' }}">
                                    <a href="{{ route('msg.dispatch') }}" class="side-txt-blu">Message Dispatch</a>
                                </li>
                                <li
                                    class="{{ in_array(Route::currentRouteName(), ['email.address']) ? 'active' : '' }}">
                                    <a href="{{ route('email.address') }}" class="side-txt-blu">Email
                                        Addresses</a></li>
                                <li
                                    class="{{ in_array(Route::currentRouteName(), ['quick.signup']) ? 'active' : '' }}">
                                    <a href="{{ route('quick.signup') }}" class="side-txt-blu">Quick Signup</a>
                                </li>
                                <li
                                    class="{{ in_array(Route::currentRouteName(), ['subs.dis.status']) ? 'active' : '' }}">
                                    <a href="{{ route('subs.dis.status') }}" class="side-txt-blu">Subscriber
                                        Dispatch Status</a></li>
                                <li><a href="javascript:void(0)" class="side-txt-blu">Force FTP Dispatch</a></li>
                                <li class="{{ in_array(Route::currentRouteName(), ['add.newuser']) ? 'active' : '' }}">
                                    <a href="{{ route('add.newuser', ['forget_session' => true]) }}" class="side-txt-blu">Add New User</a></li>
                            </ul>
                        </li>
                        <li
                            class="treeview {{ in_array(Route::currentRouteName(), ['region.data', 'city.data', 'org.data', 'autoconfirmemail', 'QReport', 'style.templates']) ? 'active' : '' }}">
                            <a href="javascript:void(0)">Config
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ in_array(Route::currentRouteName(), ['region.data']) ? 'active' : '' }}">
                                    <a href="{{ route('region.data') }}" class="side-txt-blu">Regions</a></li>
                                <li class="{{ in_array(Route::currentRouteName(), ['city.data']) ? 'active' : '' }}"><a
                                        href="{{ route('city.data') }}" class="side-txt-blu">Cities</a></li>
                                <li class="{{ in_array(Route::currentRouteName(), ['org.data']) ? 'active' : '' }}"><a
                                        href="{{ route('org.data') }}" class="side-txt-blu"></i>Organization Categories</a></li>
                                <li
                                    class="{{ in_array(Route::currentRouteName(), ['autoconfirmemail']) ? 'active' : '' }}">
                                    <a href="{{ route('autoconfirmemail') }}" class="side-txt-blu">Edit the
                                        confirmation email</a></li>
                                <li class="{{ in_array(Route::currentRouteName(), ['QReport']) ? 'active' : '' }}"><a
                                        href="{{ route('QReport') }}" class="side-txt-blu">Quick-Report
                                        Options</a></li>
                                <li
                                    class="{{ in_array(Route::currentRouteName(), ['style.templates']) ? 'active' : '' }}">
                                    <a href="{{ route('style.templates') }}" class="side-txt-blu">Style Templates/Report Pages</a></li>
                            </ul>
                        </li>
                        <li
                            class="treeview {{ in_array(Route::currentRouteName(), ['psub_list', 'purg_subs', 'email.changeTool']) ? 'active' : '' }}">
                            <a href="javascript:void(0)">Public Subscribers
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ in_array(Route::currentRouteName(), ['psub_list']) ? 'active' : '' }}"><a
                                        href="{{ route('psub_list') }}" class="side-txt-blu">Subscribers List</a></li>
                                <li class="{{ in_array(Route::currentRouteName(), ['purg_subs']) ? 'active' : '' }}"><a
                                        href="{{ route('purg_subs') }}" class="side-txt-blu">Purge Subscribers</a></li>
                                <li
                                    class="{{ in_array(Route::currentRouteName(), ['email.changeTool']) ? 'active' : '' }}">
                                    <a href="{{ route('email.changeTool') }}" class="side-txt-blu">Email Change Tool</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($data[0]->SecurityLevel == 3 || $data[0]->SecurityLevel == 2)
                <li
                    class="treeview {{ in_array(Route::currentRouteName(), ['closure.reports', 'station.recipiant', 'userorgmngmnt']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="fw-bold"><span>Regional Administration</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ in_array(Route::currentRouteName(), ['closure.reports']) ? 'active' : '' }}">
                            <a href="{{ route('closure.reports') }}" class="side-txt-blu">Closure Reports</a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['station.recipiant']) ? 'active' : '' }}">
                            <a href="{{ route('station.recipiant') }}" class="side-txt-blu">Station/Recipient List</a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['userorgmngmnt']) ? 'active' : '' }}">
                            <a href="{{ route('userorgmngmnt') }}" class="side-txt-blu">User/Org Management</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($data[0]->bActivated != 0)
                <li
                    class="treeview always-open {{ in_array(Route::currentRouteName(), ['fa.closurereports', 'fa.closurereportssubmission', 'fa.postnewsrelease', 'emr.report.arch', 'news.media.recipients']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="fw-bold"><span>FlashAlert Tools</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu cst-opn-menu">
                        <li class="{{ in_array(Route::currentRouteName(), ['fa.closurereports']) ? 'active' : '' }}">
                            <a href="{{ route('fa.closurereports') }}" style="color:red; font-weight:400;">Post Closure or Emerg Report</a>
                        </li>
                        @if ($data[0]->SecurityLevel == 3)
                            <li
                                class="{{ in_array(Route::currentRouteName(), ['fa.closurereportssubmission']) ? 'active' : '' }}">
                                {{-- <a href="{{ route('fa.closurereportssubmission') }}" class="side-txt-blu">Closures for Sub-Org</a> --}}
                                <a href="{{route('closure.reports')}}" class="side-txt-blu">Closures for Sub-Org</a>
                            </li>
                        @endif

                        <li class="{{ in_array(Route::currentRouteName(), ['fa.postnewsrelease']) ? 'active' : '' }}">
                            <a href="{{ route('fa.postnewsrelease') }}" class="side-txt-green">Post News Release(Non-Emerg) </a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['emr.report.arch']) ? 'active' : '' }}">
                            <a href="{{ route('emr.report.arch') }}" class="side-txt-blu">Emergency Report Archive</a>
                        </li>
                        <li class="">
                            <a href="{{ route('fa.postnewsrelease') }}" class="side-txt-blu">News Release Archive</a>
                        </li>
                        <li
                            class="{{ in_array(Route::currentRouteName(), ['news.media.recipients']) ? 'active' : '' }}">
                            <a href="{{ route('news.media.recipients') }}" class="side-txt-blu">List of news media recipients</a>
                        </li>
                        <li class="">
                            <a href="@if ($data[0]->URLName != '') {{ url('id/' . $data[0]->URLName) }} @endif"
                                target="_blank" class="side-txt-blu"> View your posting on FlashAlert</a>
                        </li>
                        <li class="">
                            <a href="http://www.flashalertportland.net/closures-cats.html" target="_blank" class="side-txt-blu">View Current Local Emerg</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="treeview always-open">
                <a href="javascript:void(0)" class="fw-bold">
                    <span>Account Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu cst-opn-menu">
                    <li class="">
                        <a href="{{url('IIN/orginform/' . base64_encode($data[0]->OrgID))}}" class="side-txt-blu">Manage your org’s account
                            {{-- @if (@$data[0]->SecurityLevel == 3)
                                (FlashAlert)
                            @else
                                @php
                                    $getName = Helper::getDataID('orgs', $data[0]->OrgID, 'id');
                                @endphp
                                ({{ @$getName[0]->Name }})
                            @endif --}}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('logout') }}" class="fw-bold text-red"><span>Sign out</span></a>
            </li>
        </ul>
    </section>
</aside>
<script>
    // Get a reference to the "Global Administration" link
    var globalAdminLink = document.getElementById('globalAdminToggle');
    // Prevent the default click behavior
    globalAdminLink.addEventListener('click', function(e) {
        e.preventDefault();
    });
    // ----------------------------------------------
    jQuery(document).ready(function() {
        // query to always open the global admin sidebar
        var alwaysOpen = jQuery(".always-open");
        var cstOpnMenu = jQuery(".cst-opn-menu");
        var hoverDown = jQuery(".cst-hover-down");

        alwaysOpen.addClass("menu-open");
        cstOpnMenu.css("display", "block");
        // qury to show sidebar options on hover
        jQuery(".hover-show").hover(function() {
            jQuery(this).addClass("menu-open");
            jQuery(this).find(" .cst-hover-show").slideDown("slow");
        }, function() {
            jQuery(this).removeClass("menu-open");
            // $(this).find(" .cst-hover-show").slideUp("slow");
        });
        jQuery(hoverDown).hover(function() {
            jQuery(this).addClass("menu-open");
            jQuery(this).find("ul").slideDown("slow");
        })
    });
</script>
