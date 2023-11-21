<?php 
// echo '<pre>';
// print_r($data);
// die;
?>

@extends('frontend.layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<style>
.my-email-add table tr td {
    border: 1px solid #ddd;
}

.msgr-subs-tabs li .nav-link {
    padding: 8px 20px;
    font-size: 13px;
    font-weight: 600;
    color: #666;
}

.msgr-subs-tabs li .nav-link:hover {
    background: #bbdae5;
    opacity: 1;
}

.msgr-subs-tabs li .nav-link.active {
    background: #bbdae5;
    color: #2e2e2e;
    border-bottom: 2px solid #097397;
}

.bg-e3 {
    background: #eee;
}

.msngr-tab-cont .tab-pane.active {
    min-height: 45vh;
}
</style>
<!-- @if (Session::has('success'))
    <script>
        toastr.success('{{ Session::get("success") }}', 'Success', { timeOut: 4000 });
        setTimeout(function () {
            window.location.href = '{{ route("sub-dashboard") }}';
        }, 4000);
    </script>
@endif -->
@if (Session::has('success'))
    <script>
        swal({
                    title: "Done!",
                    text: "{{ Session::get('success') }}",
                    icon: "success",
                    timer: 3000
                });
    </script>
@endif






<section>
    <div style="background: #c5e3ed">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="intro-box ">
                <div class="intro-text d-flex justify-content-center align-items-center">
                    <h1>MANAGE YOUR MESSENGER SUBSCRIPTION</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- <?php
        //echo"<pre>";
        // print_r($data);
        // die;
        ?> --}}
             @php
                $org=Helper::getDataID1('publicusersubscription',$data[0]->id,'PublicUserID');
             @endphp
    <div id="content">
        <div id="content-core">
            <div class="acount-info row align-items-center mb-3">
                @foreach ($data as $item)
                <h4 class="col-lg-8">Welcome, {{ $item->EmailAddress }}</h4>
                @endforeach
                <a href={{ route('msgsublogout') }} class="col-lg-4 text-end">
                    <i class="fa fa-power-off mx-1" aria-hidden="true"></i> Logout
                </a>

            </div>
            <ul class="msgr-subs-tabs nav nav-tabs ml-0 justify-content-between bg-e3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-msg"
                        type="button" role="tab" aria-controls="home" aria-selected="true">My Email Address
                        <span>{{count($data1)}}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">My Linked Phone
                        Apps</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">My Subscriptions
                        <span>{{count($org)}}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="add-subscriber" data-bs-toggle="tab" data-bs-target="#addSubs"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">add Subscriptions
                        <span></span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="acc-setting" data-bs-toggle="tab" data-bs-target="#accSet"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">Account Settings
                        <span></span></button>
                </li>
            </ul>
            <div class="tab-content msngr-tab-cont" id="myTabContent">
                <div class="tab-pane fade show active p-4 border" id="home-msg" role="tabpanel"
                    aria-labelledby="home-tab">
                    <div class="my-email-add table-responsive">
                        <table class="table table-bordered fw-6">
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($data1 as $datas1)

                                <tr>
                                    <form method="post" action="{{route('validatecode')}}">
                                        @csrf
                                        @if($datas1->IsPrimary ==1)
                                        <td>Primary Email</td>
                                        @else
                                        <td>Email#<?php echo $i; ?></td>
                                        @endif
                                        <td>
                                            <input class="form-control border-0" type="hidden" value="{{$datas1->id}}"
                                                name="hidden">
                                            <div class="tbl-input-email">
                                                <input class="form-control border-0" type="text"
                                                    value="{{$datas1->UserEmailAddress}}">
                                                @if($datas1->Validated!=1)
                                                <span class="text-danger">Validation email sent. <a
                                                        href="{{url('resendcode/'.$datas1->id)}}">Click here to send
                                                        validation email again.</a>
                                                </span>
                                                @php
                                                $dateTimeFromDatabase = $datas1->CreateDate;
                                                $currenttime = \Carbon\Carbon::now();
                                                $timeDifferenceInMinutes =
                                                $currenttime->diffInMinutes($dateTimeFromDatabase);
                                                @endphp
                                                @if($timeDifferenceInMinutes < 2) <span class="text-danger timer">
                                                    </span>

                                                    @endif
                                                    <br>
                                                    @if (Session::has('msg'))
                                                    <script>
                                                    swal({
                                                        title: "Opps!",
                                                        text: "{{ Session::get('msg') }}",
                                                        icon: "error",
                                                        timer: 3000
                                                    });
                                                    </script>
                                                    @endif
                                                    <label for="" class="form-label">Enter code from validation
                                                        message</label>
                                                    <input class="form-control border" type="text" value=""
                                                        name="validatedcode">
                                                    <span>Alerts are not sent to non-validated addresses.</span>
                                                    @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="tbl-btns">
                                                <!-- <input type="submit" name="submit" value="UPDATE"> -->
                                                <button type="submit" class="btn btn-outline-warning">Update</button>
                                                <!-- <button type="button" class="btn btn-outline-primary">Send Test</button> -->
                                                <a href="{{url('sendtest/'.$datas1->id)}}" class="btn btn-outline-primary">Send Test</a>
                                                @if($datas1->IsPrimary !=1)
                                                <a href="{{url('deleteemail/'.$datas1->id)}}"
                                                    class="btn btn-outline-danger">Delete</a>
                                                @endif
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <?php $i++; ?>
                                @endforeach

                                <!-- <tr>
                                        <td>Email #2</td>
                                        <td>
                                            <div class="tbl-input-email">
                                                <input class="form-control border-0" type="text"
                                                    value="">
                                            </div>
                                           <div>
                                                <span class="text-danger">Enter validation code and press Update to
                                                    submit.</span><br>
                                                <label for="" class="form-label">Enter code from validation
                                                    message</label>
                                                <input class="form-control border" type="text" value="">
                                                <span>Alerts are not sent to non-validated addresses.</span>
                                            </div> 
                                        </td>
                                        <td class="align-middle">
                                            <div class="tbl-btns">
                                                <button type="button" class="btn btn-outline-warning">Update</button>
                                                <button type="button" class="btn btn-outline-primary">Send Test</button>
                                                <button type="button" class="btn btn-outline-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr> -->
                                @if(count($data1)<2) 
                                <tr>
                                    <form method="post" action="{{route('adduseremail')}}">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{$data[0]->id}}">
                                        <td>Email #2</td>
                                        <td>
                                            <div class="tbl-input-email">
                                                <input class="form-control border-0" type="text" value="" name="email">
                                                @error('email')
                                                <span style="color:red;"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="tbl-btns">
                                                <button type="submit" class="btn btn-outline-success">Add</button>
                                            </div>
                                        </td>
                                    </form>
                                    </tr>
                                    @endif
                                    @if(count($data1)<3) 
                                    <tr>
                                        <form method="post" action="{{route('adduseremail')}}">
                                            @csrf
                                            <input type="hidden" name="userid" value="{{$data[0]->id}}">
                                            <td>Email #3</td>
                                            <td>
                                                <div class="tbl-input-email">
                                                    <input class="form-control border-0" type="text" value=""
                                                        name="email">
                                                    @error('email')
                                                    <span style="color:red;"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="tbl-btns">
                                                    <button type="submit" class="btn btn-outline-success">Add</button>
                                                </div>
                                            </td>
                                        </form>
                                        </tr>
                                        @endif
                            </tbody>
                        </table>

                        <div class="tbl-cautions mt-5">
                            <ul style="font-size:10pt;">
                                <li><span class="fw-6">Be aware that with the explosion of spam and the resulting
                                        spam filters, it is impossible to guarantee message delivery, since different
                                        filters block different messages. FlashAlert dispatches all messages within five
                                        minutes of being posting. Your email server and/or cell company may delay
                                        messages. Remember that text messages truncate after 150 characters.</span></li>
                                <li><span class="fw-6"><em>Due to cell phone companies delaying or shortening text
                                            messages, we strongly discourage the use of cell text
                                            numbers.</em></span><br>We encourage you to download the free Android/iOS
                                    phone/tablet app, FlashAlert Messenger, which uses push notification, a method
                                    <strong class="fw-6">much faster and more reliable</strong> than text messages
                                    (go to "My Linked Phone Apps" tab above).
                                </li>
                                <li>If you absolutely must get a text (i.e. no smartphone) and understand that support
                                    is not available for text addresses, you may enter it in the form of an email
                                    address. Click <a href="" target="_blank">here</a> for a list of formats by
                                    cell company.</li>
                                <li>Note that if you register for news releases, they are sent to email addresses only,
                                    but can be viewed in the phone app.</li>
                                <li>All addresses registered on FlashAlert will remain confidential. Each summer, you
                                    will receive a message at your primary email address asking if you wish to continue
                                    your subscription and to confirm your address(es).</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade p-4 border" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class=""><strong class="fw-6">Your iOS and Android devices that have the FlashAlert
                            Messenger app linked to this account:</strong><br><br><span
                            style="font-weight:bold;color:#C40F29;">No mobile apps connected.</span><br>
                        <p style="font-size:10pt;">The FlashAlert Messenger app allows you receive and view push
                            notifications on your tablet or smart phone. Push notifications are faster and more reliable
                            than text messaging. <strong class="fw-6">If you get a new phone, you must delete the old
                                one and add the new one (the notifications are sent based on the phone ID token, not the
                                phone number).</strong> <a href="" target="_blank">Click here to learn more
                                about the Messenger app or if you are having connection issues</a>.</p>
                        <p style="font-size:10pt;">The free FlashAlert Messenger app is available on <a href=""
                                target="_blank"> iTunes app store.</a></p>
                    </div>
                </div>
                <div class="tab-pane fade p-4 border" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <p class="fw-6">Organizations that you are subscribed to</p>

                    <div class="">
                        <form method="post" action="{{route('updatenewssubs')}}">
                       
                            @csrf
                            @foreach($org as $orgs)
                           
                            <div class="row">
                                <input type="hidden" name="hidden" value="{{@$orgs->id}}">
                                <div class="four columns"><span class="fw-6">
                                        @php
                                        $orgname=Helper::getDataID1('orgs',$orgs->OrgID ,'id');
                                        @endphp
                                        @foreach($orgname as $orgna)
                                        <h4>{{$orgna->Name}}</h4>
                                        @endforeach
                                    </span></div>
                                <div class="form-check">
                                <input type="hidden" name="Ealertup" value="0">
                                    <input class="form-check-input" name="Ealertup" type="checkbox" value="1" id="flexCheckDefault_{{$orgs->id}}"
                                        @if($orgs->EmergSub == 1) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault_{{$orgs->id}}">
                                        Emergency Alerts
                                    </label>
                                </div>
                                <div class="form-check">
                                <input type="hidden" name="Nreleaseup" value="0">
                                    <input class="form-check-input" name="Nreleaseup" type="checkbox" value="1" id="flexCheckChecked_{{$orgs->id}}"
                                        @if($orgs->NewsSub == 1) checked @endif>
                                    <label class="form-check-label" for="flexCheckChecked_{{$orgs->id}}">
                                        News Releases
                                    </label>
                                </div>

                                <div class="text-end">
                                    <input type="Submit" class="py-2 px-4 " value="Update">
                                    <a href="{{url('deletesubscription/'.$orgs->id)}}"  class="py-2 px-4" onclick="return confirm('Are You Sure You Want To Delete?')">Delete</a>
                                </div>
                            </div>
                           
                            @endforeach
                        </form>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="tab-pane fade p-4 border" id="addSubs" role="tabpanel" aria-labelledby="add-subscriber">
                    <p class="fw-bold">Subscribe to an Organization</p>
                    <p class="">Please note that all schools & orgs use FlashAlert for media notifications, but
                        not all offer a subscription option for the public.</p>

                    <strong class="fw-6">Find your org by <span class="text-danger">searching</span> by Region or
                        <span class="text-danger">Search all Orgs</span></strong>
                    <form method="post" id="formSearch">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="" class="form-label fw-6">Region</label>
                                <select class="form-select py-3" style="font-size: 12px;"
                                    aria-label="Default select example" id="regionSelect">
                                    <option value="">Any Region</option>
                                    @php
                                        $region = Helper::getDataID('regions')->sort(function ($a, $b) {
                                            return strcmp($a->Description, $b->Description);
                                        });
                                    @endphp
                                    @foreach($region as $regions)
                                    <option value="{{$regions->id}}">{{$regions->Description}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="" class="form-label fw-6">Search</label>
                                <input class="form-control border" type="text" value="" id="serchtext">
                            </div>
                           
                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="py-2 px-4 text-white" style="display:none;" id="reset">Reset</button>
                                <input type="Submit" class="py-2 px-4" value="Search">
                            </div>
                            </form>
                            <div class="col-lg-12 mt-3" id="showorg" style="display:none;">
                            <p>Organization:</p>
                                <select name="cars" size="10" id="cars" style="width:100%;">
                                    
                                </select>
                            </div>
                           
                            <div class="col-lg-6 mt-3" id="showsubscriber" style="display:none;">
                            <h4>Check the types of messages you would like to receive :</h4>
                              <div class="ml-4">
                                <h4 id="orgname"></h4>
                                <form method="post" action="{{route('addsubscription')}}">
                                    @csrf
                                <input type="hidden" name="userid" value="{{@$data[0]->id}}">
                                <input type="hidden" name="orgid" value="" id="orgid">
                                <div class="form-check">
                                <input type="hidden" name="Ealert" value="0">
                                    <input class="form-check-input" name="Ealert" type="checkbox" value="1" id="flexCheckDefault"
                                      checked >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Emergency Alerts
                                    </label>
                                </div>
                                <div class="form-check">
                                <input type="hidden" name="Nrelease" value="0">
                                    <input class="form-check-input" name="Nrelease" type="checkbox" value="1" id="flexCheckChecked"
                                      checked >
                                    <label class="form-check-label" for="flexCheckChecked">
                                        News Releases
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <input type="Submit" class="py-2 px-4 " value="SUBSCRIBE">
                                    <!-- <input type="Submit" class="py-2 px-4 " value="CANCEL"> -->
                                </div>
                                </form>
                                <div class="mt-3">
                                Also available on :  <a here="">Twitter</a> | <a here="">Facebook</a>
                                    
                                </div>
                              </div> 
                            </div>
                            
                        </div>
                    
                </div>
                <div class="tab-pane fade p-4 border" id="accSet" role="tabpanel" aria-labelledby="acc-setting">
                    <p class="fw-6 ">Change your Account Password</p>
                    <form method="post" action="{{route('changePasswrd')}}">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" name="reset_pass_id" value="{{session::get('ret')}}">
                            <label for="" class="form-label fw-6">New Password</label>
                            <input class="form-control border" type="password" value="" name="newpassword">
                            @error('newpassword')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label fw-6">Confirm Password</label>
                            <input class="form-control border" type="password" value="" name="confirm_new_password">
                            @error('confirm_new_password')
                                <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-12 mt-3 text-end">
                            <input type="Submit" class="py-2 px-4 " value="Change password">
                        </div>
                    </div>
                    <div class="del-account mt-3">
                        <p>Delete your FlashAlert account</p>
                        <a href="{{url('deletesubscriptionaccount/'.session::get('ret'))}}" class="btn btn-danger p-3 text-white" onclick="return confirm('Are You Sure You want to Delete Account?')">Delete this Account</a>
                    </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</section>


<script>
var timerSeconds = 120;

function updateTimer() {
    var minutes = Math.floor(timerSeconds / 60);
    var seconds = timerSeconds % 60;
    $('.timer').text(minutes + ':' + (seconds < 10 ? '0' : '') + seconds);
    if (timerSeconds === 0) {
        $('.timer').text('Resend Code');
    } else {
        timerSeconds--;
    }
}
setInterval(updateTimer, 1000);




$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#regionSelect').on('change', function() {
        
        $('#serchtext').val('');
        $('#cars').html('');
        var selectedValue = $(this).val();
        var url ="{{route('showorganization')}}"
        $.ajax({
            type: 'POST', 
            url: url, 
            data: { id: selectedValue },
            success: function(response) {
                if(response!=""){
                $('#showorg').show();
                $('#cars').append(response);
                }else{
                $('#showorg').hide();  
                }
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });



    $('#formSearch').submit(function(e){

     $("#showsubscriber").show();
     $('#cars').html('');
      e.preventDefault();
      var serchtext= $('#serchtext').val();
      var selectedvalue= $('#regionSelect').val();
      
      $("#orgname").text(serchtext+' :');
      var url ="{{route('showorganizationbyserch')}}"
        $.ajax({
            type: 'POST', 
            url: url, 
            data: { id: selectedvalue, searchvalue:serchtext },
            success: function(response) {
                if(response!=""){
                $('#showorg').show();
                $('#cars').append(response);
                $("#reset").show();
                var orgid=$('#optgroupid').val();
                $('#orgid').val(orgid);
                }else{
                $('#showorg').hide();  
                }
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });

    });
    $("#reset").click(function(e){
        $('#cars').html('');
        $("#reset").hide();
      e.preventDefault();
      var selectedValue= $('#regionSelect').val();
      $('#serchtext').val('');
      var url ="{{route('showorganization')}}"
        $.ajax({
            type: 'POST', 
            url: url, 
            data: { id: selectedValue },
            success: function(response) {
                if(response!=""){
                $('#showorg').show();
                $('#cars').append(response);
                $("#reset").hide();
                $("#showsubscriber").hide();
                }else{
                $('#showorg').hide();  
                }
                //console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    })
    $('#cars').on('change', function() {
        $("#showsubscriber").show();
        

        var selectedValue = $(this).val();
        $("#orgid").val(selectedValue);


    });
   
});
</script>
@endsection