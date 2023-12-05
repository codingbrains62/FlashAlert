@php 
//echo '<pre>';
//print_r($response);
//die;
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Message Dispatch')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Message Dispatch
            <!-- <small>Preview</small> -->
        </h1>
        <ol class="breadcrumb fw-bold font-14">
            <li>
                <a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Message Dispatch</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <form role="form" method="post" action="" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Select</label>
                                        <select class="form-control" name="firstselectbox" onchange="this.form.submit()">
                                            <option selected="" value="">*</option>
                                            <option value="1"    @if ("1" == $firstselectbox) selected @endif>1</option>
                                            <option value="2"    @if ("2" == $firstselectbox) selected @endif>2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select class="form-control" id="regionDropdown" name="region" onchange="this.form.submit(),updateOrgCatSelect()">
                                            <option value="">All</option>
                                                @foreach($data as $datas)
                                                <option value="{{ $datas->id }}"  @if ($datas->id == $selectedRegion) selected @endif>{{$datas->Description}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Last Paid</label>
                                        <select class="form-control" name="yearpaid" onchange="this.form.submit()">
                                            <option selected="" value="">Any</option>
                                            <option value="Yes"  @if ("Yes" == $amountpaid) selected @endif>Yes</option>
                                            <option value="2023" @if ("2023" == $amountpaid) selected @endif>2023</option>
                                            <option value="2022" @if ("2022" == $amountpaid) selected @endif>2022</option>
                                            <option value="2021" @if ("2021" == $amountpaid) selected @endif>2021</option>
                                            <option value="2020" @if ("2020" == $amountpaid) selected @endif>2020</option>
                                            <option value="2019" @if ("2019" == $amountpaid) selected @endif>2019</option>
                                            <option value="2001" @if ("2001" == $amountpaid) selected @endif>2001</option>
                                            <option value="2000" @if ("2000" == $amountpaid) selected @endif>2000</option>
                                            <option value="220"  @if ("220" == $amountpaid) selected @endif>220</option>
                                            <option value="never" @if ("never" == $amountpaid) selected @endif>Never</option>
                                        </select>
                                    </div>
                                </div>
                                @if($category!='')
                                <div class="col-md-4" id="getcat">
                                <div class="form-group">
                                    <label>Select Organization Category</label>
                                    <select class="form-control" id="orgCatSelect" name="orgCatSelect" onchange="this.form.submit()">
                                        <option value="">All</option> 
                                        @foreach($category as $categories)
                                        <option value="{{ $categories->id }}" @if ($categories->id == $selectedorgcat) selected @endif>{{$categories->CatagoryName}}</option> 
                                        @endforeach
                                    </select>
                                    </div>      
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> From: (Email Address)</label>
                                        <input type="text" class="form-control" name="email"
                                            value="support@flashalert.net"
                                             />
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title_name" class="form-control" name="title" value="">
                                     <span class="error-message" style="color:red;" id="title-error"></span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mb-3">Email Body</label>
                                        <textarea name="emailbody" id="dis_email" class="form-control" ></textarea>
                                    <span class="error-message" style="color:red;" id="emailbody-error"></span>
                                    </div>
                                    
                                </div>
                               
                            </div>
                        <div><b>Message Recipients: </b> 
                          <!--    @error('clientemail')
                                <span style="color:red;" role="alert"><strong>{{str_replace('The clientemail field is required.',' Select Atleast One Checkbox ',$message)  }}</strong></span>
                            @enderror -->
                            <span class="error-message" style="color:red;" id="clientemail-error"></span>
                        </div>
                        <div><input type="checkbox" id="chkAll"> All</div>
                    </div>
                </div>
            </div>
            @if (!empty($response) && $response->count() > 0)
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                               @php 
                               $current_state = null;
                               foreach ($response as $datas){
                               $state_name =  $datas->CatagoryName;
                               $city_name = $datas->Name;
                               if($state_name != $current_state) {
                               $current_state = $state_name;
                               @endphp
                                <tr style="background-color:#495A6D; color:#fff;">
                                    <th colspan="3">{{$state_name}}</th>
                                    
                                </tr>
                               @php 
                               }
                               @endphp 
                            </thead>
                            <tbody>
                                <tr >
                                    @if($datas->FlashAlertSubscriber!=0)
                                    <td style="width:4%;opacity: 0.5;" class="text-center"><b>M</b></td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td><input type="checkbox" name="clientemail[]" id="chk" class="chk" value="{{@$datas->PrimaryWorkEmail}}"> {{ ucwords(@$city_name) }}</td>
                                    <td> 
                                        @php
                                        $date = @$datas->DateLastPaid;
                                        $year = substr($date, 0, 4);
                                        $output = ($year === '0000') ? 'Never' : $year;
                                        if($year === '0000' || $datas->AmountPaid==''){
                                            $output="Never";
                                        }else{
                                            $output=$year;  
                                        }
                                        @endphp
                                        {{ $output }}
                                     </td>
                                </tr>
                            @php 
                            }
                            @endphp
                            </tbody>
                        </table>
                        <div class="d-flex">
                           {{ $response->appends(request()->except('page'))->links() }}
                        </div>
                        <b>Send Mail:</b> Only recipients currently shown on the screen will be mailed.
                        <div class="row mt-3 justify-end d-flex">
                            <div class="col-xs-5 col-sm-3 col-md-2"><a href="{{route('msg.dispatch')}}" class="btn btn-primary btn-block">Reset</a></div>
                            <div class="col-xs-5 col-sm-3 col-md-2 text-right"><button type="submit" class="btn btn-success btn-block pull-right" id="formsubmit" onclick="jumpToTop();">Submit</button></div>
                        </div>                        
                    </div>
                </div>
                </form>
            </div>
            @else
            <div class="col-xs-12">
                <div class="alert alert-info">
                    No recipients available.
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
    <script>
         $(document).on('change', '#msgdisregion', function() {
    var id = $(this).val();
    var url = "{{route('get.quickcatmsg')}}"
    $.ajax({
        url: url,
        method: 'get',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function(result) {
           
            $("#getcat").html(result);
            
        }
    });
    });

    // $("#chkAll").change(function () {
    // $("input:checkbox").prop('checked', $(this).prop("checked"));
    // });


    $(document).ready(function() {
      $("#chkAll").click(function() {
        var isChecked = $(this).prop("checked");
        $(".chk").prop("checked", isChecked);
      });
      $(".chk").click(function() {
        var allChecked = $(".chk").length === $(".chk:checked").length;
        $("#chkAll").prop("checked", allChecked);
      });
    });



    // $(document).on('click', '#formsubmit', function(e) {
    //     e.preventDefault();
    //     var url = "{{route('mail.all')}}"
    //     var formData = new FormData($('#myForm')[0]);
    //     $.ajax({
    //     url: url,
    //     method: 'post',
    //     data: formData,
    //     processData: false,
    //     contentType: false, 
    //     success: function(result) {
    //        Swal.fire({
    //           title: "Good job!",
    //           text: 'Email Sent Succesfully',
    //           icon: "success",
    //           timer: 6000
    //         });
           

    //        //alert(result);
    //       // console.log(result);
            
    //     }
    // });   
    
    // });
    

    $(document).ready(function () {
        $('form').submit(function (event) {
            event.preventDefault();

            var formData = $(this).serialize();
            // Replace 'YOUR_CUSTOM_URL' with the actual URL to handle the form submission in your Laravel controller.
            var url = '{{route('mail.all')}}';

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.message === 'Emails sent successfully') {
                        toastr.success('Email Sent Successfully', 'Good job!', { timeOut: 4000 });
                         setTimeout(function () {
                           window.location.href = response.url;
                        }, 4000);

                        
                    }
                    //alert(response.message);
                },
                error: function (xhr, status, error) {
                    var errors = xhr.responseJSON.errors;

                    // Show the errors in the form fields
                    $.each(errors, function (key, value) {
                        if (key === 'clientemail') {
                            // If the error is for the clientemail field, use a custom message
                            $('#clientemail-error').text('Select Atleast One Checkbox');
                        } else {
                            // For other fields, display the original error message
                            $('#' + key + '-error').text(value[0]);
                        }
                    });
                },
            });
        });
        // Event listener for the email body textarea
    $('#title_name').on('input', function () {
        if ($(this).val().trim() !== '') {
            // Clear the error message for the email body field
            $('#title-error').text('');
        }
    });
    $('#chk').click(function () {
        // Clear the error message for "Message Recipients"
        $('#clientemail-error').text('');
    });
    });
function jumpToTop() {
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: 'smooth'
  });
}
    </script>
    <script>
        CKEDITOR.replace("dis_email", {
            language: "en",
            uiColor: "#dddddd",
            height: 100,
            resize_dir: 'vertical'
        });
        // Add an event listener to CKEditor instance
    CKEDITOR.instances.dis_email.on('change', function () {
        if (this.getData().trim() !== '') {
            // Clear the error message for the email body field
            $('#emailbody-error').text('');
        }
    });
    </script>
@endsection