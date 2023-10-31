@php
//echo '<pre>';
//print_r($response);
//die;
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Business Partner')
@section('content')
<style>
    .bigbutton {
    font-weight: bold;
    padding: 5px;
    font-size: 11pt;
    min-width: 150px;
    border-radius: 2px;
    -moz-border-radius: 2px;
    border: 0px;
    box-shadow: 1px 1px #999;
    text-shadow: 1px 1px #EEE;
}
fieldset legend {
    font-weight: bold;
    background: #495A6D;
    padding: 5px 15px;
    border-radius: 5px;
    border: 1px solid #EEE;
    color: white;
    width:130px;
    font-size: 14px;
    
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Business Partners
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Business Partners</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                    @if(isset($response4[0]))
                    <div class="row"><div class="col-md-12 text-right"><a href="{{url('IIN/orginform/'. base64_encode($response4[0]->OrgID))}}" class="btn btn-info">Back</a></div></div>
                    @else
                    <div class="row"><div class="col-md-12 text-right"><a href="{{url('IIN/orginform/'. base64_encode($response3[0]->OrgID))}}" class="btn btn-info">Back</a></div></div>
                    @endif
                        <form role="form" method="post" action="{{route('insert.business.partner')}}" id="myForm">
                            @csrf
                            <div class="row">
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
                                <script>
                                    swal({
                                        title: "Done!",
                                        text: "{{ Session::get('failed') }}",
                                        icon: "error",
                                        timer: 5000
                                        
                                    });
                                </script>
                                @endif
                                <input type="hidden" name="hidden" value="{{@$response2[0]->id}}">
                                @if(isset($response2[0]))
                                <input type="hidden" name="UserID" value="{{@$response2[0]->UserID}}">
                                @else
                                <input type="hidden" name="UserID" value="{{@$id}}">
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Name :</label>
                                        <input type="text" class="form-control" name="PartnerName"
                                            value="{{@$response2[0]->PartnerName}}"
                                             />
                                    @error('PartnerName')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    </div>
                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address : <span class="text-danger"><b> *</b></span></label>
                                        <input type="email" class="form-control" name="EmailAddress"
                                            value="{{@$response2[0]->EmailAddress}}"
                                             />
                                    @error('EmailAddress')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Notifications : <span class="text-danger"><b> *</b></span></label><br>
                                        <input type="radio" name="PartnerType" value="1" @if(@$response2[0]->NotifyType ==1) checked @endif> News Releases<br>
                                        <input type="radio" name="PartnerType" value="2" @if(@$response2[0]->NotifyType ==2) checked @endif> Emergency Msgs<br>
                                        <input type="radio" name="PartnerType" value="3" @if(@$response2[0]->NotifyType ==3) checked @endif @if(@$response2[0]->NotifyType=='') checked @endif> Both
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Group :</label><br>
                                        <select class="form-control" name="GroupName">
                                            <option selected="" value="">-N/A</option>
                                             @foreach($response1 as $responses1)
                                            <option value="{{$responses1->id}}" @if ($responses1->id == @$response2[0]->GroupID) selected @endif>{{ucwords($responses1->GroupName)}}</option>
                                             @endforeach
                                        </select>
                                    @error('GroupName')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                      @if(isset($response2[0]))
                                       <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                       <a href="{{url('IIN/buninesspartner/'. base64_encode($response2[0]->UserID))}}"  class="btn btn-default">Cancel</a>
                                       <a href="{{url('IIN/addgrouppartner/'. base64_encode($response2[0]->UserID))}}" class="btn btn-default">Manage Groups</a>
                                       @else
                                       <input type="submit" name="submit" value="Add" class="btn btn-success">
                                       <a href="{{url('IIN/addgrouppartner/'. base64_encode($id))}}" class="btn btn-default">Manage Groups</a>
                                       @endif
                                       
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-hover" style="font-size:12px;">
                            <thead>
                            <tr style="background-color:#495A6D; color:#fff;">
                                    <th>Name:</th>
                                    <th>Email Address:</th>
                                    <th>Messages:</th>
                                    <th>Action:</th>
                            </tr>
                               @php 
                               $current_state = null;
                               foreach ($response as $datas){
                               $state_name =  $datas->GroupName;
                               if($state_name != $current_state) {
                               $current_state = $state_name;
                               @endphp
                                <tr style="background-color:#CCC; color:black;">
                                    <th colspan="4">{{ucwords($state_name)}}</th>
                                </tr>
                               @php 
                               }
                               @endphp 
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$datas->PartnerName}}</td>
                                    <td>{{$datas->EmailAddress}}</td>
                                    <td>{{$datas->PartnerType}}</td>
                                    
                                    <td>
                                    <a href="{{url('IIN/editbuninesspartner/'. base64_encode($datas->partner_id))}}" class="btn btn-warning btn-xs">Edit</a>
                                    <a href="{{url('IIN/deletebusinesspartner/'. base64_encode($datas->partner_id))}}" class="btn btn-danger btn-xs" onclick="showConfirmDialog(event)">Delete</a>
                                    </td>
                                   
                                </tr>
                            @php 
                            }
                            @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            




            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                    Import/Export Mailing List
                    <div class="p-3 mt-2" style="background-color:#495A6D;color:#fff; padding: 7px"><span class="ml-2">Mailing Lists:</span></div> 
                    <div class="col" style="background-color:white;margin: 1em; padding:1em 2em;">
                        <p><strong>Recommendations:</strong></p>
                        <p>Create separate CSV files for students and staff to enhance flexibility, allowing customization of notifications and messages for each group.</p>
                        <p>To create a CSV file, use <strong>Export</strong> to download a template. Edit the template in Excel, Google Sheets, or similar programs to update names and email addresses for recipients.  Make sure that the file is still in CSV (comma-seperated values) and not an XLS or other format.</p><p>After creating the file(s), follow these steps:</p>
                        <ol>
                            <li>Go to "<strong>1. Replace Partner Group</strong>", use "New/Edit" to name the list(s), and click "Select."</li>
                            <li>Move to "<strong>2. Select a CSV file from your computer</strong>" and pick the desired file.</li>
                            <li>Press "<strong>3. Import</strong>" to finish the process.</li>
                        </ol>
                        <p>Remember, each import overwrites the previous list. Update as needed, perhaps monthly.</p>
                    </div>
                    <fieldset style="margin-bottom:15px;">
                      <legend>Edit Groups</legend>
                      <p>To create, rename or delete groups: 
                        @if(isset($response2[0]))
                        <a href="{{url('IIN/addgrouppartner/'. base64_encode($response2[0]->UserID))}}" class="btn btn-default">Manage Groups</a>
                        @else
                        <a href="{{url('IIN/addgrouppartner/'. base64_encode($id))}}" class="btn btn-default bigbutton">Manage Groups</a></p>
                        @endif
                      
                      
                      
                      <!-- <a href="{{url('IIN/addgrouppartner/'. base64_encode($id))}}" class="btn btn-default bigbutton">Manage Groups</a></p> -->
                    </fieldset>

                      <fieldset style="margin-bottom:15px;">
                      <legend>Export</legend>
                        <div class="row">
                            <form method="post" action="{{route('createcsv')}}">
                                @csrf
                                <div class="col-md-6">
                                        <p>
                                        <label for="GroupID">
                                            <strong>Select Partner Group:</strong>
                                        </label><br>
                                        <label>
                                            <input type="radio" name="GroupID" value="" checked=""> Ungrouped Partners
                                        </label><br>
                                        <label>
                                        @foreach($response1 as $responses1)
                                            <input type="radio" name="GroupID" value="{{$responses1->id}}"> {{ucwords($responses1->GroupName)}}<br>
                                        @endforeach
                                        </label><br>
                                    
                                        <br>
                                        <input type="submit" class="btn btn-lg btn-primary" name="BulkPartnerDownload" value="Export Group as CSV file">
                                    </p>
                                </div>
                            </form>
                            <div class="col-md-6"><p>
                                    <i>If this is a new group, use this to download a CSV file template.</i>
                                </p>
                                <a href="{{url('/IIN/static/sample.csv')}}" target="_blank" class="btn btn-default bigbutton">Download sample.csv</a>
                                <br>
                            </div>
                        </div>
            </fieldset>

            <fieldset style="margin-bottom:15px;">
                      <legend>Import</legend>
                        <div class="row">
                            <form method="post" action="{{route('importcreatecsv')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="UserID" value="{{@$id}}">
                                <div class="col-md-6">
                                        <p>
                                        <label for="GroupID">
                                            <strong>1 - Replace Partner Group:</strong>
                                        </label><br>
                                        <label>
                                            <input type="radio" name="GroupID" value="" checked=""> Select
                                        </label><br>
                                        <label>
                                        @foreach($response1 as $responses1)
                                            <input type="radio" name="GroupID" value="{{$responses1->id}}"> {{ucwords($responses1->GroupName)}}<br>
                                        @endforeach
                                        </label><br>
                                        <a href="{{url('IIN/addgrouppartner/'. base64_encode($id))}}" class="btn btn-default bigbutton">New/Edit</a>
                                        <br>
                                        <p>This will replace all records in this group.</p>
                                        <p>Ungrouped partners cannot be replaced.</p>
                                        <h4>2 - Select a CSV file from your computer</h4>
                                        <input type="file" name="csvfile" class="form-control">
                                        <br>
                                        <input type="submit" class="btn btn-lg btn-primary" name="BulkPartner" value="3- Import">
                                    </p>
                                </div>
                            </form>
                        </div>
            </fieldset>


                     
                      
                    </div>
                    
                </div>
               
            </div>
        </div>
    </section>
   
</div> 
@endsection