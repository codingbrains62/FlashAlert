@php
    //echo '<pre>';
    //print_r($data);
    //die;
    //Session::get('loginId');
    $data = Helper::getDataID('users', Session::get('loginId'), 'id');
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Organization information')
@section('content')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .scroll-top {
            /*        display:none;*/
        }

        .scroll-top.activate {
            display: block;
            position: fixed;
            z-index: 99;
            right: 12px;
            top: 50px;
            color: #fff;
            background: #097397;
            padding: 9px 12px;
            animation: fadeIn 0.5s ease-in-out;

        }
    </style>
    <div class="content-wrapper">
        @if (Session::has('success'))
            <script>
                swal({
                    title: "Done!",
                    text: "{{ Session::get('success') }}",
                    icon: "success",
                    timer: 3000
                });
            </script>
            <!-- <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                        {{ Session::get('success') }}
                    </div> -->
        @elseif (Session::has('failed'))
            <script>
                swal({
                    title: "Done!",
                    text: "{{ Session::get('failed') }}",
                    icon: "error",
                    //timer: 3000
                });
            </script>
        @endif
        <div class="content">
            <div class="row">
                <div class="col-md-12" style="position:relative">
                    <div class="scroll-top text-right mb-1">
                        <b>Jump to : </b>
                        <button id="jumpToTopButton" type="button" class="btn btn-danger btn-xs" style="display:none;"><i
                                class="fa fa-fw fa-arrow-circle-up"></i> Top</button>
                        <button id="jumpToSaveButton" type="button" class="btn btn-danger btn-xs"><i
                                class="fa fa-fw fa-floppy-o"></i> Save Button</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <div class="row">
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <h3 class="box-title font-sm12">Organization Information: ( <span>Id:
                                            {{ $response1[0]->id }}</span>, <span>Name: {{ $response1[0]->Name }}</span> )
                                    </h3>
                                </div>
                                <div class="col-md-2 text-right">
                                    @php
                                        $previousUrl = url()->previous();
                                    @endphp
                                    <!-- <a href="{{ $previousUrl }}" class="btn btn-info btn-xs">Back</a> -->
                                    <a href="{{ route('userorgmngmnt') }}" class="btn btn-info btn-xs">Back</a>
                                    <!-- <a href="{{ route('userorgmngmnt') }}" class="btn btn-info btn-xs ">Back</a> -->
                                </div>
                            </div>
                        </div>
                        <form role="form" method="post" action="{{ route('edit.org.data') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body org-info">
                                <input type="hidden" name="hidden" value="{{ $response1[0]->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>All information will remain confidential.</b>
                                    </div>
                                    <div class="col-md-6 text-right text-start-sm">
                                        {{-- <input type="button" class="outline-btn" value=""> --}}
                                        <a href="{{ url('IIN/sub-cat/' . base64_encode($response1[0]->id)) }}"
                                            class="outline-btn fw-6">Add New Sub-Org</a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="my-0">Region <span class="text-danger">*</span>
                                            </label><br>
                                            <small>Select a geography, save, then choose a category and save again.</small>
                                            <select class="form-control" size="1" name="region">
                                                @php
                                                    $getData = Helper::getData('regions', '', 'Description', 'asc');
                                                    $region = Helper::getDataID('regions', $response1[0]->RegionID, 'id');
                                                @endphp
                                                @foreach ($getData as $getDatas)
                                                    <option value="{{ $getDatas->id }}"
                                                        @if ($getDatas->id == $region[0]->id) selected @endif>
                                                        {{ $getDatas->Description }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="my-0">Category <span
                                                    class="text-danger">*</span></label><br>
                                            <small>Choose a category for your organization.</small>
                                            <select class="form-control" size="1" name="category">
                                                @php
                                                    $getData = Helper::getDataID('orgcats', $response1[0]->RegionID, 'RegionID');
                                                    $region = Helper::getDataID('orgcats', $response1[0]->OrgCatID, 'id');
                                                @endphp
                                                @foreach ($getData as $getDatas)
                                                    <option value="{{ $getDatas->id }}"
                                                        @if ($getDatas->id == $region[0]->id) selected @endif>
                                                        {{ $getDatas->CatagoryName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data[0]->SecurityLevel == 1)
                                        <input type="hidden" name="bActivated" value="1">
                                    @endif
                                    @if ($data[0]->SecurityLevel == 3 || $data[0]->SecurityLevel == 2)
                                        @if ($data[0]->SecurityLevel == 3)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="checkbox">
                                                    <input type="hidden" name="invisible" value="0">
                                                    <label> <input type="checkbox" name="invisible" value="1"
                                                            @php if(isset($response[0])){
                                            echo (($response1[0]->Invisible )==1 ? 'checked' : '');} @endphp>
                                                        Invisible </label> <br>
                                                    <input type="hidden" name="regionlocked" value="0">
                                                    <label> <input type="checkbox" name="regionlocked" value="1"
                                                            @php if(isset($response[0])){
                                            echo (($response[0]->TestAccount)==1 ? 'checked' : '');} @endphp>
                                                        Test Account (Regions Locked) </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="">
                                                    <label> Subscription Tier</label>
                                                    <select class="form-control" name="Tier" size="1">
                                                        @if ($response[0]->Tier == 1)
                                                            <option value="1" selected>Tier 1 (Default)</option>
                                                            <option value="2">Tier 2 (Free)</option>
                                                        @else
                                                            <option value="2">Tier 2 (Free)</option>
                                                            <option value="1">Tier 1 (Default)</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-2 col-md-6">
                                            <div class="">
                                                <label> Account Activated </label>
                                                <select class="form-control" name="bActivated" size="1">
                                                    @if ($response[0]->bActivated == 1)
                                                        <option value="1" selected="">On</option>
                                                        <option value="0">Off</option>
                                                    @else
                                                        <option value="0">Off</option>
                                                        <option value="1">On</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <div class="checkbox">
                                                <input type="hidden" name="hibernation" value="0">
                                                <label> <input type="checkbox" value="1" name="hibernation"
                                                        @php if(isset($response[0])){
                                            echo (($response[0]->Hibernation)==1 ? 'checked' : '');} @endphp>
                                                    In Hibernation </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <p class="text-muted">
                                            <strong>Account Created :</strong> <span
                                                class="bg-light">{{ $response[0]->DateAdded && $response[0]->DateAdded != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateAdded)->format('d/m/y') : '00-00-0000' }}</span>,
                                            <strong>Last Modified :</strong> <span
                                                class="bg-light">{{ $response[0]->DateUpdated && $response[0]->DateUpdated != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateUpdated)->format('d/m/y') : '00-00-0000' }}</span>
                                        </p>
                                        <b>Your News Pages :</b>
                                        <span>
                                            <a href="" class="badge fw-6 bg-blue">HTML</a>
                                            <a href="" class="badge fw-6 bg-red">RSS</a>
                                            <a href="" class="badge fw-6 bg-blue">Plain-text emergency,</a>
                                            <a href="" class="badge fw-6 bg-green">JSON emergency</a>
                                            <a href="" class="badge fw-6 bg-blue">HTML News Releases</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <!-- <div class="col-md-3">
                                        <label> Account Activated </label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker">
                                        </div>
                                    </div> -->
                                    @if ($data[0]->SecurityLevel == 1)
                                        <input type="hidden" name="lastpaid" class="form-control"
                                            value="{{ $response[0]->DateLastPaid && $response[0]->DateLastPaid != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateLastPaid)->format('m/d/y') : '00-00-0000' }}">
                                        <input type="hidden" name="yearpaidfor" class="form-control"
                                            value="{{ $response[0]->DateLastPaid && $response[0]->DateLastPaid != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateLastPaid)->format('Y') : '00-00-0000' }}">
                                        <input type="hidden" name="yearpaidfor" class="form-control"
                                            value="{{ $response[0]->DateLastPaid && $response[0]->DateLastPaid != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateLastPaid)->format('Y') : '00-00-0000' }}">
                                    @endif
                                    @if ($data[0]->SecurityLevel != 1)
                                        <div class="col-md-5">
                                            <label> Last Paid on: <Span> 
                                                    (MM/DD/YY) </Span></label>
                                            <input type="text" name="lastpaid" class="form-control"
                                                value="{{ $response[0]->DateLastPaid && $response[0]->DateLastPaid != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateLastPaid)->format('m/d/y') : '00-00-0000' }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label> Year Paid For: <Span>
                                                 (YYYY) </Span></label>
                                            <input type="text" name="yearpaidfor" class="form-control"
                                                value="{{ $response[0]->DateLastPaid && $response[0]->DateLastPaid != '0000-00-00 00:00:00' ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateLastPaid)->format('Y') : '00-00-0000' }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label> Amount Paid: </label>
                                            <input type="text" name="amountpaid" class="form-control"
                                                value="{{ $response[0]->AmountPaid }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label> Administrative Notes:</label>
                                            <input type="text" name="notes" class="form-control"
                                                value="{{ $response[0]->Notes }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- login form of edit page --}}
                            <div class="box border-0">
                                <div class="box-header with-border cus-head">
                                    <h3 class="box-title font-sm12">Login</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label> Username <span class="text-danger">*</span></label>
                                            <small>It can be an abbreviation and is NOT case sensitive.</small>
                                            <input type="text" class="form-control" name="UserName"
                                                value="{{ $response[0]->UserName }}">
                                        </div>
                                        @error('UserName')
                                            <span style="color:red;"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="mr-2"> Password</label>
                                            <small> To change, enter your new password twice. It should be 8-64 letters,
                                                numbers
                                                and symbols (not case sensitive). </small>
                                            <input type="password" class="form-control" name="password" class="password"
                                                autocomplete="new-password">
                                            @error('password')
                                                <span style="color:red;"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                            <br>
                                            <label> Confirm password</label>
                                            <input type="password" class="form-control" name="confirm_password"
                                                class="password" autocomplete="new-password">
                                            @error('confirm_password')
                                                <span style="color: red;"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                            <div class="checkbox my-2">
                                                <label> <input type="checkbox" id="showPass1"> <strong
                                                        id="showPassText1">Show Password</strong></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- login form of edit page end --}}

                            {{-- message setting section --}}
                            <div class="box border-0">
                                <div class="box-header with-border cus-head">
                                    <h3 class="box-title font-sm12">FlashAlert Messenger Settings</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Activate FlashAlert Messenger</strong>
                                            <p class="font-13">Allow the public to self register to receive your
                                                <strong>emergency
                                                    messages</strong> as emails or phone app push notifications?</p>
                                            <div class="radio my-0" style="display:inline-block">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1"
                                                        value="1" <?php echo $response[0]->FlashAlertSubscriber == 1 ? 'checked' : ''; ?>>

                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio mx-3" style="display:inline-block">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1"
                                                        value="0" <?php echo $response[0]->FlashAlertSubscriber == 0 ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="fon">In addition to emergencies, enable your Messenger subscribers
                                                to
                                                receive your <strong>news releases</strong> ?</p>
                                            <div class="radio my-0" style="display:inline-block">
                                                <label>
                                                    <input type="radio" name="optionsRadios1" id="optionsRadios1"
                                                        value="1" <?php echo $response[0]->FlashAlertNews == 1 ? 'checked' : ''; ?>>
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio mx-3" style="display:inline-block">
                                                <label>
                                                    <input type="radio" name="optionsRadios1" id="optionsRadios2"
                                                        value="0" <?php echo $response[0]->FlashAlertNews == 0 ? 'checked' : ''; ?>>
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Restricted User Registration</strong>
                                            <p class="font-13 text-justify">Enter your district/company/org’s email suffix
                                                (i.e.@flashalert.net, @hp.com, @katu.com) to only allow Messenger
                                                subscribers
                                                with an email address with that suffix to subscribe. Leave blank to allow
                                                anyone
                                                to subscribe.</p>
                                            <input type="text" class="form-control">
                                            <small>Changing this does not remove currently active subscriptions.</small>
                                            <p class="mt-3"><strong>Subscribers:</strong> You currently have
                                                {{ count($response5) }} subscribers
                                                with 0 phone/tablet apps installed.</p>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="disablenewsubs">
                                                    Disable New Subscribers
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message setting section end --}}

                            {{-- facebook settings section --}}
                            <div class="box border-0">
                                <div class="box-header with-border cus-head">
                                    <h3 class="box-title font-sm12">Facebook Settings</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Post Emergency Messages to Facebook</strong>
                                            <p class="font-13">FlashAlert can report your <strong
                                                    class="text-danger font-14">emergency</strong> reports and <Strong
                                                    class="font-14" style="color: chocolate">news releases</Strong> on
                                                your
                                                organization's Facebook page. If you don't have one yet, you can <a
                                                    href="https://www.facebook.com/pages/create" target="_blank">create a
                                                    new Facebook page here</a>.</p>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a class="btn btn-block btn-social btn-facebook">
                                                <i class="fa fa-facebook"></i> Begin Facebook Integration
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <i>You will be redirected to Facebook. Log in with an account that has posting
                                                permission to your org's Facebook page.</i>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <b>Display Link to Your Facebook Page</b><br>
                                            <i class="font-13">If you don't want FlashAlert to automatically post messages
                                                to
                                                your Facebook page, but would
                                                still like to display the page's URL to FlashAlert visitors, you may enter
                                                your
                                                Facebook page URL here</i><br>
                                            <input class="form-control fb-input" type="text" name="facebookurl"
                                                id="" value="{{ $response[0]->FacebookURL }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- facebook settings section end --}}

                                {{-- twitter seting section --}}
                                <div class="box border-0">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Twitter Settings</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong>Post FlashAlert Messages to Twitter</strong>
                                                <p class="font-13">FlashAlert can repost your reports to your
                                                    organization's
                                                    account on Twitter. If you don't have one yet, you can <a
                                                        href="https://twitter.com/i/flow/login?redirect_after_login"
                                                        target="_blank">create
                                                        a new Twitter page here</a>.</p>

                                            </div>
                                            <div class="col-md-12">
                                                <strong>Display Link to Your Twitter Page</strong><br>
                                                <i class="font-13">If you don't want FlashAlert to automatically post
                                                    messages to
                                                    your Twitter account, but would still like
                                                    to display your Twitter URL to FlashAlert visitors, you may enter your
                                                    Twitter
                                                    account name here</i>
                                                <div class="input-group">
                                                    <span class="input-group-addon">@</span>
                                                    <input type="text" class="form-control fb-input"
                                                        name="TwitterUser" placeholder="Username"
                                                        value="{{ $response[0]->TwitterUser }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- twitter seting section end --}}

                                {{-- media monitoring section --}}
                                <div class="box border-0">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Media Monitoring Settings</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><a href="http://www.yournewsinc.net/" target="_blank">YourNewsInc</a>
                                                    monitors your local news media for your news
                                                    release and reports back to you which stations/papers ran your story.
                                                    Statewide
                                                    and national search is also available.</p>

                                                <div class="checkbox d-flex">
                                                    <label>
                                                        <input type="hidden" name="enablemedia" value="0">
                                                        <input type="checkbox" name="enablemedia" value="1"
                                                            @php if(isset($response[0])){
                                            echo (($response[0]->EnableMediaMonitor)==1 ? 'checked' : '');} @endphp>
                                                        <b>Enable Media Monitoring </b>
                                                    </label>
                                                    <p class="ml-3">- Free to new YNI users. YNI will contact you to set
                                                        up the
                                                        coverage reporting</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- media monitoring section end --}}
                                @if ($data[0]->SecurityLevel != 3)
                                    <input type="hidden" name="SecurityLevel"
                                        value="{{ $response[0]->SecurityLevel }}">
                                @endif
                                @if ($data[0]->SecurityLevel == 3)
                                    {{-- Region Administration section --}}
                                    <div class="box border-0">
                                        <div class="box-header with-border cus-head">
                                            <h3 class="box-title font-sm12">Region Administration</h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>Security Level</b>
                                                    <select class="form-control" name="SecurityLevel" size="1">
                                                        <option value="1"
                                                            @if ($response[0]->SecurityLevel == 2) selected @endif>User.
                                                        </option>
                                                        <option value="2"
                                                            @if ($response[0]->SecurityLevel == 2) selected @endif>Regional
                                                            Admin.</option>
                                                        <option value="3"
                                                            @if ($response[0]->SecurityLevel == 3) selected @endif>Global Admin.
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <b>Statewide Access</b>
                                                    <div class="d-flex f-wrap checkbox-div space-between">
                                                        @foreach ($response2 as $responses2)
                                                            @php
                                                                $orgregion = Helper::getOrgRegion('orgregions', $response1[0]->id, $responses2->id, 'RegionID');
                                                                $isChecked = !$orgregion->isEmpty();
                                                            @endphp
                                                            <div class="checkbox mt-0">
                                                                <label>
                                                                    <input type="checkbox" name="regionValue[]"
                                                                        value="{{ $responses2->id }}"
                                                                        {{ $isChecked ? 'checked' : '' }}>
                                                                    {{ $responses2->Description }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- Region Administration section --}}

                                {{-- Organization Contact Info section --}}
                                <div class="box border-0">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Organization Contact Info</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="">Organization Name <span
                                                            class="text-danger">*</span>
                                                    </label><br>
                                                    <small> This is the official name that will appear in the reports. It
                                                        should be
                                                        as short as possible
                                                        and may be edited for consistency in style with similar
                                                        organizations.</small>
                                                    <input type="text" class="form-control" name="OrgName"
                                                        value="{{ $response1[0]->Name }}">
                                                    @error('OrgName')
                                                        <span style="color: red;"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class=""> Simplified URL <span
                                                            class="text-danger">*</span>
                                                    </label><br>
                                                    <small> A shortened version of your org name for a simplified URL for
                                                        your news
                                                        page for the public.
                                                        (Note: Changing this may break any links you are using to any
                                                        previous
                                                        simplified URL .)</small>
                                                    <i class="col-md-3 control-label">flashalert.net/id/</i>
                                                    <div class="">
                                                        <input type="text" name="URLName" class="form-control"
                                                            value="{{ $response[0]->URLName }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="">Organization Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="Address" class="form-control"
                                                        value="{{ $response[0]->Address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-2">
                                                <div class="form-group">
                                                    <label for="" class="">City <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="City" class="form-control"
                                                        value="{{ $response[0]->City }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-2">
                                                <div class="form-group">
                                                    <label for="" class="">State <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="State" class="form-control"
                                                        value="{{ $response[0]->State }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-2">
                                                <div class="form-group">
                                                    <label for="" class="">Zipcode <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="Zipcode" class="form-control"
                                                        value="{{ $response[0]->Zipcode }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class=" text-danger">Email address for invoices
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" name="BillingEmail" class="form-control"
                                                        value="{{ $response[0]->BillingEmail }}">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <b>Your Organization's Logo</b>
                                                <p>Your logo will appear on your news release emails and <a
                                                        href="">your
                                                        customized FlashAlert page</a>.</p>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">File to be uploaded</label><br>
                                                    <small> (Remember to use conventional file names, i.e. only letters and
                                                        numbers)</small>
                                                    <input type="hidden" name="oldImage"
                                                        value="{{ $response1[0]->LogoMediaFileID }}">
                                                    <input type="file" id="exampleInputFile" class="cst-input-file"
                                                        name="orglogo">
                                                    <p class="help-block">
                                                        Example block-level help text here.
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <b>Your Organization's Logo</b>
                                                <br>
                                                @if (isset($logo[0]))
                                                    <img src="{{ $logo[0]->ThumbURL }}" height="300" width="300"
                                                        class="img-thumbnail img-fluid">
                                                @endif
                                            </div>



                                            <div class="col-md-6">
                                                <b>Your organization's home page URL</b>
                                                <input type="text" name="URL" class="form-control"
                                                    value="{{ $response[0]->URL }}">
                                            </div>
                                            <div class="col-md-6">
                                                <b>Closure guidelines URL</b>
                                                <small> Your organization's emergency closure guidelines URL on your
                                                    website.Populates the More Info field in emergency messages.</small>
                                                <input type="text" name="closureguidlineurl" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <b>Default Contact Info for News Media</b>
                                                <small>(Auto-filled on news releases)</small>
                                                <textarea class="form-control" name="DefaultContactInfo" cols="20" rows="4">{{ $response[0]->DefaultContactInfo }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Organization Contact Info section --}}

                                {{-- Primary Contact section --}}
                                <div class="box border-0">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Primary Contact</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="">Name of Primary Contact<span
                                                            class="text-danger">*</span><br>
                                                        <small>(Replies to news emails will go to this person)</small>
                                                    </label>
                                                    <input type="text" name="PrimaryName" class="form-control"
                                                        value="{{ $response[0]->PrimaryName }}">

                                                </div>
                                                @error('PrimaryName')
                                                    <span style="color: red;"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="">Office Phone Number<span
                                                            class="text-danger">*</span><br>
                                                    </label>
                                                    <input type="text" name="PrimaryPhone" class="form-control"
                                                        value="{{ $response[0]->PrimaryPhone }}">
                                                </div>
                                                @error('PrimaryPhone')
                                                    <span style="color: red;"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="">Office Email Address<span
                                                            class="text-danger">*</span><br>
                                                        <small>(Receives a copy of all messages posted.)</small>
                                                    </label>
                                                    <input type="email" name="PrimaryWorkEmail" class="form-control"
                                                        value="{{ $response[0]->PrimaryWorkEmail }}">
                                                </div>
                                                @error('PrimaryWorkEmail')
                                                    <span style="color: red;"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Primary Contact section --}}

                                {{-- Secondary Contact section --}}
                                <div class="box border-0">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Secondary Contact</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="">Name of Secondary Contact<span
                                                            class="text-danger"><span> </label>
                                                    <input type="text" name="SecondaryName" class="form-control"
                                                        value="{{ $response[0]->SecondaryName }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="">Office Phone Number<span
                                                            class="text-danger"></span><br>
                                                    </label>
                                                    <input type="text" name="SecondaryWorkEmail" class="form-control"
                                                        value="{{ $response[0]->SecondaryWorkEmail }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="">Office Email Address<span
                                                            class="text-danger"></span><br>
                                                        <small>(Receives a copy of all messages posted.)</small>
                                                    </label>
                                                    <input type="email" name="SecondaryPhone" class="form-control"
                                                        value="{{ $response[0]->SecondaryPhone }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Secondary Contact section --}}

                                {{-- payment section --}}
                                <div class="box border-0">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Payment</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>If payment is due, you may</p>
                                                <ol>
                                                    <li><a href="https://zohosecurepay.com/checkout/8wkrz69-zhaj5jyg9zd0k/FlashAlert-Newswire"
                                                            target="_blank">Pay with a credit card by clicking here.</a>
                                                    </li>
                                                    <li>Or, send a check to: <br>
                                                        FlashAlert Newswire <br>
                                                        61572 Searcy Ct., Bend OR 87702. Fed Tax ID 91-2021669</li>
                                                    <li><a href="http://www.flashalertnewswire.net/w9.pdf"
                                                            target="_blank">Click here to obtain a copy of FlashAlert's
                                                            Federal Tax
                                                            Form W-9 </a></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- payment section --}}

                                {{-- Save Changes & User Agreement section --}}
                                <div class="box border-0" id="saveButton">
                                    <div class="box-header with-border cus-head">
                                        <h3 class="box-title font-sm12">Save Changes & User Agreement</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4><img src="https://cdn-icons-png.flaticon.com/128/497/497738.png"
                                                        alt="warning" class="img-fluid"
                                                        style="width: 25px;height: 25px;  margin: 5px;"><b
                                                        class="text-danger">STOP ! </b> If you made changes above, press
                                                    the Save
                                                    button before continuing to sections below.</h4>
                                                <p>By clicking Save, you agree to our <a href="">Terms of Use and
                                                        Privacy
                                                        Policy.</a></p>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-2 mb-sm8">
                                                <button type="submit" class="btn btn-block btn-success"><i
                                                        class="fa fa-floppy-o mx-1" aria-hidden="true"></i> Save</button>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-2 mb-sm8">
                                                <button type="button" class="btn btn-block btn-primary"><i
                                                        class="fa fa-times mx-1" aria-hidden="true"></i> Cancel</button>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-2">
                                                <a href="{{ url('IIN/delorg/' . base64_encode($response1[0]->id)) }}"
                                                    class="btn btn-block btn-danger" onclick="showConfirmDialog(event)"><i
                                                        class="fa fa-trash mx-1" aria-hidden="true"></i> Delete
                                                    Account</a>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                    </div>
                    {{-- Save Changes & User Agreement section --}}

                    {{-- Business Partners & membership section  --}}
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <h3 class="box-title font-sm12">OrgGroup Memberships & Business Partners</h3>
                        </div>

                        <form role="form" method="post" action="{{ route('add.group') }}">
                            @csrf
                            <input type="hidden" name="grouporg" value="{{ @$response[0]->OrgID }}">
                            <div class="box-body">
                                <div class="row">
                                    @if ($data[0]->SecurityLevel == 3 && $data[0]->SecurityLevel != 2 && $data[0]->SecurityLevel != 1)
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12"> <small>All members of a group can post to each
                                                        other's subscribers.</small></div>
                                                <div class="col-sm-8 col-md-8 mb-sm8">
                                                    <select class="form-control" name="orggroupid">
                                                        <option selected value="">Select Group</option>
                                                        @foreach ($response6 as $responses6)
                                                            <option value="{{ $responses6->id }}"}>
                                                                {{ $responses6->OrgGroupName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('orggroupid')
                                                        <span style="color:red;"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="outline-btn my-0">Add</button>
                                                    <button class="outline-btn my-0 text-left" name="action"
                                                        value="delete">Delete</button>
                                                </div>


                                                <div class="col-md-12 mt-4 ml-4">
                                                    @foreach ($response7 as $responses7)
                                                        <b>. {{ $responses7->OrgGroupName }}</b><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <p>FlashAlert Newswire can e-mail your emergency messages and news releases to the
                                            following addresses (in addition to the news media)</p>
                                        <a href="{{ url('IIN/buninesspartner/' . base64_encode($response[0]->id)) }}"
                                            class="outline-btn mt-3 pull-right">Manage Business
                                            Partners</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- Business Partners & membership section  --}}

                    {{-- Default Dispatch Selections section  --}}
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <h3 class="box-title font-sm12">Default Dispatch Selections</h3>
                        </div>

                        <form method="post" action="{{ route('default.dispatch') }}">
                            @csrf
                            <input type="hidden" name="grouporg1" value="{{ @$response[0]->OrgID }}">
                            <div class="box-body">
                                <div class="row m-0">
                                    <p>Select the cities below that you would like to have checked by default on your
                                        emergency messages and news releases. Cities in red have TV and/or radio stations;
                                        cities in black are newspaper-only.</p>
                                    <div class="col-md-12 border-check">
                                        <div>
                                            @foreach ($response3 as $responses3)
                                                @php
                                                    $cities = Helper::cityData('regioncities', $responses3->id, 'CityRank', 'asc');
                                                @endphp
                                                <div class="checkbox mt-0">
                                                    <label>
                                                        <span><b>{{ $responses3->Description }}</b>
                                                            @foreach ($cities as $city)
                                                                @php
                                                                    $orgregion1 = Helper::getOrgRegion('defaultcities', $response1[0]->id, $city->cid, 'CityID');
                                                                    $isChecked1 = !$orgregion1->isEmpty();
                                                                @endphp
                                                                <div class="checkbox mt-0">
                                                                    <label>

                                                                        <input type="checkbox" name="regionValue[]"
                                                                            value="{{ $city->cid }}"
                                                                            {{ $isChecked1 ? 'checked' : '' }}>
                                                                        {!! $city->CityName !!}
                                                                    </label>
                                                                </div>
                                                            @endforeach

                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                            @foreach ($response4 as $responses4)
                                                @php
                                                    $orgregion2 = Helper::getOrgRegion('defaultcities', $response1[0]->id, $responses4->cid, 'CityID');
                                                    $isChecked2 = !$orgregion2->isEmpty();
                                                @endphp
                                                <div class="checkbox" style="margin-left:20px;">
                                                    <label>

                                                        <input type="checkbox" name="regionValue[]"
                                                            value="{{ $responses4->cid }}"
                                                            {{ $isChecked2 ? 'checked' : '' }}>
                                                        {!! $responses4->CityName !!}
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div style="margin-left:20px;">
                                            <b>Other Recipients:</b>
                                            <div class="checkbox mt-0">
                                                <label>
                                                    <input type="checkbox" name="businesspartner" value="1"
                                                        @php if(isset($response[0])){
                                            echo (($response[0]->DefaultMailBusinessPartners)==1 ? 'checked' : '');} @endphp>
                                                    Business Partners
                                                </label><br>
                                                @if ($response[0]->FlashAlertSubscriber != '')
                                                    <label>
                                                        <input type="checkbox" name="FlashAlertSubscriber" value="1"
                                                            @php if(isset($response[0])){
                                            echo (($response[0]->FlashAlertSubscriber)==1 ? 'checked' : '');} @endphp>
                                                        Messenger (Public) Subscribers
                                                    </label>
                                                @endif
                                                <br>
                                                @if ($response[0]->DefaultNotifyTwitter != '')
                                                    <label>
                                                        <input type="checkbox" name="TwitterUser" value="1"
                                                            @php if(isset($response[0])){
                                            echo (($response[0]->DefaultNotifyTwitter)==1 ? 'checked' : '');} @endphp>
                                                        Twitter
                                                    </label>
                                                @endif
                                                <br>
                                                @if ($response[0]->DefaultNotifyFacebook != '')
                                                    <label>
                                                        <input type="checkbox" name="FacebookUser" value="1"
                                                            @php if(isset($response[0])){
                                            echo (($response[0]->DefaultNotifyFacebook)==1 ? 'checked' : '');} @endphp>
                                                        Facebook
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        <?php
                                        $group = Helper::getPartnersById($response[0]->id);
                                        $groupmember = Helper::groupmember($response[0]->OrgID);
                                        $groupmemberIds = [];
                                        foreach ($groupmember as $member) {
                                            $groupmemberIds[] = $member->OrgGroupID;
                                        }
                                        ?>
                                        @foreach ($group as $groups)
                                            <label style="margin-left:20px;">

                                                <span style="opacity: 60%;">L</span> <input type="checkbox"
                                                    name="GroupName[]"
                                                    value="{{ $groups->id }}"@if (in_array($groups->id, $groupmemberIds)) checked @endif>
                                                {{ $groups->GroupName }}
                                            </label>
                                            <br>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="" value="Save Default Cities"
                                            class="btn btn-primary">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section>
    </div>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                var scrollDistance = $(window).scrollTop();
                var scrollElement = $('.scroll-top');
                var jumpToTopButton = $('#jumpToTopButton');
                var jumpToSaveButton = $('#jumpToSaveButton');

                if (scrollDistance > 0) {
                    scrollElement.addClass('activate');
                    jumpToTopButton.show(); // Show the top button
                } else {
                    scrollElement.removeClass('activate');
                    jumpToTopButton.hide(); // Hide the top button
                }

                // Calculate the remaining scroll height until the bottom
                var windowHeight = $(window).height();
                var documentHeight = $(document).height();
                var remainingScrollHeight = documentHeight - scrollDistance - windowHeight;

                if (remainingScrollHeight > 100) {
                    jumpToSaveButton.show(); // Show the save button
                } else {
                    jumpToSaveButton.hide(); // Hide the save button
                }
            });

            $('#jumpToTopButton').click(function() {
                jumpToTop();
            });

            $('#jumpToSaveButton').click(function() {
                jumpToSave();

            });
        });

        function jumpToTop() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        }

        function jumpToSave() {
            const saveButton = document.getElementById('saveButton');
            saveButton.scrollIntoView({
                behavior: 'smooth'
            });

        }




        const passwordInput = document.querySelector('input[name="password"]');
        const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
        const showPassCheckbox = document.getElementById('showPass1');

        showPassCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passwordInput.type = 'text';
                confirmPasswordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirmPasswordInput.type = 'password';
            }
        });
    </script>
@endsection
