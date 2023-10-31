<?php
//echo '<pre>';
//print_r($data2);
//die;

?>
@extends('backend.layouts.backapp')
@section('title', 'Email Addresses')
@section('content')
<style>
    /* Apply basic styling to the textareas */
    textarea {
      resize: none; /* Prevent manual resizing */
      overflow-y: hidden; /* Hide vertical scrollbar */
      text-align: left; /* Align the text to the left */
    }
   /* table, th, td {
    border: 1px solid;
    }*/
    a:hover{
      text-decoration:underline;
    }
    
 
  </style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Email Addresses
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb fw-6 font-14">
            <li>
                <a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Email Addresses</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                      <div style="background-color:#495A6D; color:#fff; padding:8px; margin-bottom:7px;"><b style="margin-left:2px;">Addresses Search:</b></div> 
                           <form role="form" method="post" action="{{route('email.address')}}">
                            @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Email Address:</b></label>
                                        <input type="text" class="form-control" placeholder="Enter Email address" name="email" value="{{@$email}}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary mt1-480 mt-25">Search</button></div>
                                </div>
                              </form>
                              @if(!empty($data) && count($data) > 0 )
                                <div class="row" style="margin-left:3px;">
                                 <div class="col-md-12"><b>Media Subscribers :</b></div> 
                                 <div class="col-md-12">
                                  <table style="width:97%;" class="table table-bordered" >
                                        <tr>
                                          <td >Email</td>
                                          <td >Media Name</td>
                                        </tr>
                                        <tr>
                                          <td >{{@$data[0]->Address}}</td>
                                          <td ><a href="{{url('IIN/edit-station/'.base64_encode(@$data[0]->SubID))}}">{{@$data1[0]->Name}}</a></td>
                                        </tr>
                                  </table>
                                 </div>
                                 @endif
                                 @if(!empty($data) && count($data) < 1)
                                <div class="row" style="margin-left:3px;">
                                 <div class="col-md-12">
                                  
                                          
                                          <div><b> -No media subscriber addresses found:</b></div>
                                
                                 </div>
                                 @endif

                               
                                
                                 @if(!empty($data2) && count($data2) > 0)
                                 <div class="col-md-12 mt-2"><b>Business Partners:</b></div> 
                                 <div class="col-md-12">
                                 <table style="width:97%;" class="table table-bordered">
                                    <tr>
                                      <td>Email</td>
                                      <td>Name</td>
                                      <td>Org</td>
                                      <td>Org Login</td>
                                    </tr>
                                    @foreach($data2 as $datas2)
                                      <?php
                                        $userData = $data3->where('id', $datas2->UserID)->first();
                                        $orgData = $data4->where('id', $userData->OrgID)->first();
                                      ?>
                                      <tr>
                                        <td>{{$datas2->EmailAddress}}</td>
                                        <td>{{$datas2->PartnerName}}</td>
                                        <td><a href="{{url('IIN/orginform/' . base64_encode($orgData->id))}}">{{$orgData->Name}}</a></td>
                                        <td>{{$userData->UserName}}</td>
                                      </tr>
                                    @endforeach
                                  </table>
                                 </div>
                                 @endif
                                 @if(!empty($data2) && count($data2) < 1)
                                <div class="col-md-12 mt-2 mb-2 text-danger"><b>-No business partners found.</b></div> 
                                @endif
                                </div>
                               
                                
                                <div style="background-color:#495A6D; color:#fff; padding:8px; margin-bottom:7px; margin-top:17px;"><b style="margin-left:2px;">Email Addresses:</b></div> 
                                  <span class="ml-4"><b>Media - Emergency Recipients:</b></span> <br>
                                  <span class="ml-4">
                                      <textarea rows="200" cols="80" class="left-align-text form-control">
                                    @foreach($EmergencyRecipient as $EmergencyRecipients)
                                      {{$EmergencyRecipients->Address }}
                                    @endforeach
                                  </textarea></span><br>
                                  <span class="ml-4"><b>Media - Press Release Recipients:</b></span> <br>
                                  <span class="ml-4"><textarea rows="200" cols="80" >
                                    @foreach($PressRecipient as $PressRecipients)
                                      {{$PressRecipients->Address }}
                                    @endforeach
                                  </textarea></span><br>
                                  <span class="ml-4"><b>Business Partner Recipients:</b></span> <br>
                                  <span class="ml-4"><textarea rows="200" cols="80" >
                                    @foreach($BussinessPartner as $BussinessPartners)
                                     {{$BussinessPartners->EmailAddress }}
                                    @endforeach
                                  </textarea></span><br>
                                  <span class="ml-4"><b>Media - Sports Report Recipients:</b></span> <br>
                                  <span class="ml-4"><textarea cols="80">
                                   
                                  </textarea></span>
                          
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
   
</div>

@endsection