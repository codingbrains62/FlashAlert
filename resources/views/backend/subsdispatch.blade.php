<?php 
//echo '<pre>';
//print_r($user);
//die;
?>


@extends('backend.layouts.backapp')
@section('title','Subscriber Dispatch Status')
@section('content')
<style>
    .OK {
    background-color: #627D4D;
    background: linear-gradient(142deg, rgb(123 147 103) 17%, rgb(96 120 77) 43%);
    text-align: center;
    color: #fff;
    width: 50px;
    font-weight: 600;
}

.main > td {
    border: 1px solid white; /* You can adjust the border color and thickness as needed */
    padding: 5px; /* Add some padding to make the content look better */
  }

  .cell-gap {
    margin-right: 20px; /* Adjust this value to set the desired gap size */
  }
  .dispatch-tbl legend.patch-status {
    width: fit-content;
    font-weight: bold;
    background:#fd5c63;
    padding: 7px 14px;
    border: 1px solid #EEE;
    color: #fff;
    font-size: 14px;
    margin-bottom: 0px;
}

</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Subscriber Dispatch Status  
        </h1>
        <ol class="breadcrumb fw-6 font-14">
            <li><a href="{{url('/IIN/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Subscriber Dispatch Status</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-hover dispatch-tbl">
                            <thead>
                                <tr>
                                    <th colspan="8" style="background-color:#495A6D;color:#fff">Dispatch Status</th>
                                </tr>
                                      <tr>
                                        <th colspan="8"><h3 class="m-0"><legend class="patch-status">Scripts - Last Completed</legend></h3></th>
                                      </tr>
                                      @foreach($mtr as $mtr)
                                      <tr>
                                        <th colspan="2">{{$mtr->Page}}</th>
                                        <td colspan="6">{{$mtr->Data}}</td>
                                      </tr>
                                      @endforeach
                                <tr>
                                    <td colspan="8"><h3><legend style="width:100px;">Reports</legend></h3></td>
                                </tr>
                                <tr style="background:#ced0e9;color:#33334d;">
                                    <th>ReportID</th>
                                    <th >Org</th>
                                    <th>Last Edit</th>
                                    <th >Subs</th>
                                    <th >BP</th>
                                    <th>SubTime</th>
                                    <th>#Emails</th>
                                    <th>Twitter</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $users)
                                <tr class="main">
                                    <td>{{$users->id}}</td>
                                    <td>
                                    <b>{{$users->Name}}:</b><br>
                                    <?php
                                    $words = explode(" ", $users->Note);
                                    $first_14_words = implode(" ", array_slice($words, 0, 12));
                                    ?>
                                    {{$first_14_words }} 
                                    </td>
                                    <td>{{$users->EffectiveDate}}</td>
                                    @if($users->SendToSubs==0)
                                    <td style="text-align:center;vertical-align:middle;">NA</td>
                                    @else
                                    <td class="OK" style="vertical-align:middle;">OK</td>
                                    @endif
                                    @if($users->SendToPartners==0)
                                    <td style="text-align:center;vertical-align:middle;">NA</td>
                                    @else
                                    <td class="OK" style="vertical-align:middle;">OK</td>
                                    @endif
                                    &nbsp;&nbsp;&nbsp;
                                    <td>{{round($users->DeliverSubTimeElapsed,2)}}</td>
                                    <td>{{$users->DeliverSubNumAddress}}</td>
                                    @if($users->TwitterID==0)
                                    <td></td>
                                    @else
                                    <td>{{$users->TwitterID}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                                <tr>
                                  <th colspan="8"><h3 class="m-0"><legend class="patch-status">Emerg Subs - Last 200</legend></h3></th>
                                </tr>
                                @foreach($subscription as $res)
                                <tr>
                                    <td> [{{$res->OrgID}}]</td>
                                    @php
                                        $inputDate = $res->DateLastUpdate;
                                        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inputDate);
                                        $formattedDate = $carbonDate->format('D, d M Y H:i:s');
                                    @endphp
                                    <td> {{$formattedDate}} -0700</td>
                                    <td>#{{$res->id}}:</td>
                                    <td colspan="3">sub dispatch:</td>
                                     <?php
                                     $getEmail=Helper::getDataID2('publicuseremail',$res->PublicUserID,'PublicUserID');
                                     ?>
                                     @foreach($getEmail as $getEmails)
                                     <td colspan="2">{{$getEmails->UserEmailAddress}}</td>
                                     @endforeach
                                </tr>
                                @endforeach
                                 <tr>
                                  <th colspan="8"><h3 class="m-0"><legend class="patch-status">News Subs - Last 200</legend></h3></th>
                                </tr>
                                <tr>
                                    <td colspan="8">no logfile</td>
                                </tr>
                        </table>
                       
                    </div>

                </div>
            </div>

        </div>




    </section>

</div>
@endsection