@php 
//echo '<pre>';
//print_r($response);
//die;
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
    .scroll-top{
/*        display:none;*/
    }
    .scroll-top.activate{
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
    <div class="content">
        <div class="row">
             <div class="col-md-12 text-right mb-2" style="position:relative"> 
                <div class="scroll-top">
                    <b>Jump to: </b>
                    <button id="jumpToTopButton" type="button" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-arrow-circle-up"></i> Top</button>
                    <button id="jumpToSaveButton" type="button" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-floppy-o"></i> Save Button</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <div class="row">
                            <div class="col-md-10">
                            <h3 class="box-title ">Organization Information: <span>#{{$response1[0]->id}}</span></h3>
                            </div>
                            <div class="col-md-2 text-right">
                                @php 
                                $previousUrl = url()->previous();
                                @endphp
                                <a href="{{ $previousUrl }}" class="btn btn-info btn-xs">Back</a>
                            <!-- <a href="{{route('userorgmngmnt')}}" class="btn btn-info btn-xs ">Back</a> -->
                            </div>
                        </div>
                    </div>
                        @if (Session::has('success'))
                        <script>
                            swal({
                                        title: "Done!",
                                        text: "{{ Session::get('success') }}",
                                        icon: "success",
                                        timer: 3000
                                    });
                        </script>
                        @elseif (Session::has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            {{ Session::get('failed') }}
                        </div>
                        @endif
                    <form role="form" method="post" action="{{route('edit.suborg.data')}}" enctype="multipart/form-data">
                        <input type="hidden" name="hidden" value="{{$response1[0]->id}}">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <b>All information will remain confidential.</b>
                                </div>
                                <div class="col-md-6 text-right text-start-sm">
                                    {{-- <input type="button" class="outline-btn" value=""> --}}
                                    <a href="{{url('IIN/sub-cat/' . base64_encode($response1[0]->id))}}" class="outline-btn">Add New Sub-Org</a>
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
                                            @foreach($getData as $getDatas)
                                                <option value="{{$getDatas->id}}" @if($getDatas->id==$region[0]->id) selected @endif>
                                                    {{$getDatas->Description}}
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
                                            @foreach($getData as $getDatas)
                                                <option value="{{$getDatas->id}}" @if($getDatas->id==$region[0]->id) selected @endif>
                                                    {{$getDatas->CatagoryName}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="my-0">Parent Organization: <span
                                                class="text-danger">*</span></label><br>
                                        <select class="form-control" size="1" name="porganization">
                                            @php
                                            $getData1 = Helper::getDataID1('orgs',$response1[0]->RootOrgID,'id');
                                            @endphp
                                            <option value="{{$getData1[0]->id}}" selected>{{$getData1[0]->Name}}</option>
                                            @php
                                            $getData = Helper::getSubOrg($response1[0]->RootOrgID);
                                            @endphp
                                            @foreach($getData as $getDatas)
                                                <option value="{{$getDatas->id}}">
                                                    --{{$getDatas->Name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                        <div class="checkbox">
                                            <label> 
                                                <input type="hidden" name="CanMailNews" value="0">
                                                <input type="checkbox" value="1" name="CanMailNews" @php if(isset($response1[0])){
                                                echo (($response1[0]->CanMailNews)==1 ? 'checked' : '');} @endphp> Can Dispatch to Media (not just subscribers)</label>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="checkbox">
                                            <label> 
                                                <input type="hidden" name="InheritRegion" value="0">
                                                <input type="checkbox" value="1" name="InheritRegion" @php if(isset($response1[0])){
                                                echo (($response1[0]->InheritRegion)==1 ? 'checked' : '');} @endphp> Inherit region from parent org </label>
                                        </div>
                                </div>
                                <?php
                                $suborg=Helper::getDataID1('users',$response1[0]->RootOrgID,'OrgID');
                                ?>
                                <div class="col-md-6">
                                        <div class="checkbox" name="">
                                        <label><b>Subscription Tier:</b> @if($suborg[0]->Tier == '1') {{ 'Tier 1 (Default)' }} @endif</label>

                                        </div>
                                        <div class="checkbox">
                                            <label><b>Account Activated:</b> @if($suborg[0]->bActivated == '1') {{ 'ON' }} @endif  </label>
                                        </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <p class="text-muted">
                                        <strong>Account Created :</strong> <span class="bg-light">{{ ($response[0]->DateAdded && $response[0]->DateAdded != '0000-00-00 00:00:00') ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateAdded)->format('d/m/y') : '00-00-0000' }}</span>,
                                        <strong>Last Modified :</strong> <span class="bg-light">{{ ($response[0]->DateUpdated && $response[0]->DateUpdated != '0000-00-00 00:00:00') ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $response[0]->DateUpdated)->format('d/m/y') : '00-00-0000' }}</span>
                                    </p>
                                    <b>Your News Pages :</b>
                                    <span>
                                        <a href="" class="badge bg-blue">HTML</a>
                                        <a href="" class="badge bg-red">RSS</a>
                                        <a href="" class="badge bg-blue">Plain-text emergency,</a>
                                        <a href="" class="badge bg-green">JSON emergency</a>
                                        <a href="" class="badge bg-blue">HTML News Releases</a>
                                    </span>
                                </div>
                            </div>
                </div>
                {{-- login form of edit page --}}
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title ">Login</h3>
                    </div>
            
                    
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <label> Username <span class="text-danger">*</span></label>
                                    <small>It can be an abbreviation and is NOT case sensitive.</small>
                                    <input type="text" name="UserName" class="form-control" value="{{$response[0]->UserName}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="mr-2"> Password</label>
                                    <small> To change, enter your new password twice. It should be 8-64 letters, numbers
                                        and symbols (not case sensitive). </small>
                                    <input type="password" class="form-control" name="password" class="password">
                                     @error('password')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <br>
                                    <label> Confirm password</label>
                                    <input type="password" class="form-control" name="confirm_password"  class="password">
                                     @error('confirm_password')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <div class="checkbox my-2">
                                        <label> <input type="checkbox" id="showPass1"> <strong id="showPassText1">Show Password</strong></label>
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
                        <h3 class="box-title ">FlashAlert Messenger Settings</h3>
                    </div>
            
                   
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Activate FlashAlert Messenger</strong>
                                    <p class="font-13">Allow the public to self register to receive your emergency
                                        messages as emails or phone app push notifications?</p>

                                    @if($suborg[0]->FlashAlertSubscriber!=0)
                                    <div class="radio my-0" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="1"  <?php echo ($response[0]->FlashAlertSubscriber == 1) ? 'checked' : ''; ?>>

                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio mx-3" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1"
                                              value="0" <?php echo ($response[0]->FlashAlertSubscriber == 0) ? 'checked' : ''; ?> >
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="fon">In addition to emergencies, enable your Messenger subscribers to
                                        receive your <strong>news releases</strong> ?</p>
                                    <div class="radio my-0" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios1" id="optionsRadios2"
                                                value="1"  <?php echo ($response[0]->FlashAlertNews == 1) ? 'checked' : ''; ?>>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio mx-3" style="display:inline-block">
                                        <label>
                                            <input type="radio" name="optionsRadios1" id="optionsRadios2"
                                                value="0" <?php echo ($response[0]->FlashAlertNews == 0) ? 'checked' : ''; ?>>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Restricted User Registration</strong>
                                    <p class="font-13 text-justify">Enter your district/company/org’s email suffix
                                        (i.e.@flashalert.net, @hp.com, @katu.com) to only allow Messenger subscribers
                                        with an email address with that suffix to subscribe. Leave blank to allow anyone
                                        to subscribe.</p>
                                    <input type="text" class="form-control" name="RestrictedUser">
                                    <small>Changing this does not remove currently active subscriptions.</small>
                                    @else
                                    <strong>Your parent organization does not have this feature enabled.</strong>
                                    @endif
                                    <p class="mt-3"><strong>Subscribers:</strong> You currently have {{count($response5)}} subscribers
                                        with 0 phone/tablet apps installed.</p>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="DisableNewSubs">
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
                {{-- media monitoring section --}}
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title ">Media Monitoring Settings</h3>
                    </div>
                   
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><a href="http://www.yournewsinc.net/" target="_blank">YourNewsInc</a> monitors your local news media for your news
                                        release and reports back to you which stations/papers ran your story. Statewide
                                        and national search is also available.</p>
            
                                    <div class="checkbox d-flex">
                                        <label>
                                            <input type="hidden" name="MediaMonitor" value="0">
                                            <input type="checkbox" name="MediaMonitor" value="1" @php if(isset($response[0])){
                                            echo (($response[0]->EnableMediaMonitor)==1 ? 'checked' : '');} @endphp>
                                            <b>Enable Media Monitoring </b>
                                        </label>
                                        <p class="ml-3">- Free to new YNI users. YNI will contact you to set up the
                                            coverage reporting</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                </div>
                {{-- media monitoring section end --}}
            
                
            
                {{-- Organization Contact Info section --}}
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title ">Organization Contact Info</h3>
                    </div>
            
                   
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="my-0">Organization Name <span
                                                class="text-danger">*</span>
                                        </label><br>
                                        <small> This is the official name that will appear in the reports. It should be
                                            as short as possible
                                            and may be edited for consistency in style with similar
                                            organizations.</small>
                                            <div class="row mt-3">
                                               <div class="col-md-3">
                                                <b>{{$getData1[0]->Name}}-</b> 
                                               </div>
                                               <div class="col-md-8">
                                                     <input type="text" name="OrgName" class="form-control" value="{{$response1[0]->Name}}">
                                                </div>
                                            </div>  
            
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="my-0"> Simplified URL <span
                                                class="text-danger">*</span>
                                        </label><br>
                                        <small> A shortened version of your org name for a simplified URL for your news
                                            page for the public.
                                            (Note: Changing this may break any links you are using to any previous
                                            simplified URL .)</small>
                                        <i class="col-md-3 control-label">flashalert.net/id/</i>
                                        <div class="col-md-8">
                                            <input type="text" name="URLName" class="form-control" value="{{$response[0]->URLName}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <b>Your Organization's Logo</b>
                                    <p>Your logo will appear on your news release emails and <a href="">your
                                            customized FlashAlert page</a>.</p>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File to be uploaded</label><br>
                                        <small> (Remember to use conventional file names, i.e. only letters and
                                            numbers)</small>
                                        <input type="hidden" name="oldImage" value="{{$response1[0]->LogoMediaFileID}}">
                                        <input type="file" id="exampleInputFile" class="cst-input-file" name="orglogo">
                                        <p class="help-block">
                                            Example block-level help text here.
                                        </p>
                                         @error('orglogo')
                                         <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                         @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <b>Your Organization's Logo</b>
                                    <br>
                                    @if(isset($logo[0]))
                                   <img src="{{ $logo[0]->ThumbURL }}" height="300" width="300" class="img-thumbnail">
                                   @endif
                                </div> 

                                <div class="col-md-6">
                                    <b>Your organization's home page URL</b>
                                    <input type="text" name="URL" class="form-control" value="{{$response[0]->URL}}">
                                </div>
                            </div>
                        </div>
                   
                </div>
                {{-- Organization Contact Info section --}}
            
                {{-- Primary Contact section --}}
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title ">Primary Contact</h3>
                    </div>
            
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="my-0">Name of Primary Contact<span
                                                class="text-danger">*</span><br>
                                            <small>(Replies to news emails will go to this person)</small>
                                        </label>
                                        <input type="text" name="PrimaryName" class="form-control" value="{{$response[0]->PrimaryName}}">
                                         @error('PrimaryName') 
                                          <span style="color: red;" role="alert"><strong>{{ $message }}</strong></span>
                                         @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="my-0">Office Phone Number<span
                                                class="text-danger">*</span><br>
                                        </label>
                                        <input type="text" name="PrimaryPhone" class="form-control" value="{{$response[0]->PrimaryPhone}}">
                                         @error('PrimaryPhone') 
                                          <span style="color: red;" role="alert"><strong>{{ $message }}</strong></span>
                                         @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="my-0">Office Email Address<span
                                                class="text-danger">*</span><br>
                                            <small>(Receives a copy of all messages posted.)</small>
                                        </label>
                                        <input type="email" name="PrimaryWorkEmail" class="form-control" value="{{$response[0]->PrimaryWorkEmail}}">
                                         @error('PrimaryWorkEmail') 
                                          <span style="color: red;" role="alert"><strong>{{ $message }}</strong></span>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- Primary Contact section --}}
            
              
               
            
                {{-- Save Changes & User Agreement section --}}
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title ">Save Changes & User Agreement</h3>
                    </div>
            
                    
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><img src="https://cdn-icons-png.flaticon.com/128/497/497738.png"
                                            alt="warning" class="img-fluid"
                                            style="width: 25px;height: 25px;  margin: 5px;"><b
                                            class="text-danger">STOP ! </b> If you made changes above, press the Save
                                        button before continuing to sections below.</h4>
                                    <p>By clicking Save, you agree to our <a href="">Terms of Use and Privacy
                                            Policy.</a></p>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-block btn-success"><i
                                            class="fa fa-floppy-o mx-1" aria-hidden="true" id="saveButton"></i> Save</button>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-block btn-primary"><i
                                            class="fa fa-times mx-1" aria-hidden="true"></i> Cancel</button>
                                </div>
                                <div class="col-md-2">
                                <a href="{{url('IIN/delorg/'.base64_encode($response1[0]->id))}}" class="btn btn-block btn-danger" onclick="showConfirmDialog(event)"><i
                                            class="fa fa-trash mx-1" aria-hidden="true"></i> Delete Account</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Save Changes & User Agreement section --}}
            
                {{-- Business Partners & membership section  --}}
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title ">OrgGroup Memberships & Business Partners</h3>
                    </div>
            
                    <form role="form" method="post" action="{{route('add.group')}}">
                        @csrf
                        <input type="hidden" name="grouporg" value="{{@$response[0]->OrgID}}">
                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-12"> <small>All members of a group can post to each other's subscribers.</small></div>
                                 <div class="col-md-8">
                                    <select class="form-control" name="orggroupid">
                                        <option selected value="">Select Group</option>
                                        @foreach($response6 as $responses6)
                                        <option value="{{$responses6->id}}"}>{{$responses6->OrgGroupName}}</option>
                                        @endforeach
                                    </select>
                                    @error('orggroupid')
                                     <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                 </div>
                                 <div class="col-md-4">
                                 <button class="outline-btn">Add</button>  <button class="outline-btn text-left" name="action" value="delete">Delete</button>
                                 </div>
                                
                                 <div class="col-md-12 mt-4 ml-4">
                                    @foreach($response7 as $responses7)
                                      <b>. {{$responses7->OrgGroupName }}</b><br>
                                     @endforeach
                                 </div>
                              </div>
                            </div>
                                <div class="col-md-6">
                                    <p>FlashAlert Newswire can e-mail your emergency messages and news releases to the
                                        following addresses (in addition to the news media)</p>
                                        <a href="{{url('IIN/buninesspartner/'. base64_encode($response[0]->id))}}" class="outline-btn mt-3 pull-right">Manage Bussiness
                                        Partners</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Business Partners & membership section  --}}
            
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
        saveButton.scrollIntoView({ behavior: 'smooth' });

    }




    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
    const showPassCheckbox = document.getElementById('showPass1');

    showPassCheckbox.addEventListener('change', function () {
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