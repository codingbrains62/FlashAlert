@php 
//echo '<pre>';
//print_r($response);
//die;
@endphp


@extends('backend.layouts.backapp')
@section('title', 'User organization management')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Post Your News Here
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">User/Org Management</li>
            </ol>
        </section>
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
        <section class="content">
            <div class="row">
               
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: initial;">
                    {{-- </div> --}}
                    <div class=" ">

                        {{-- main data tables  --}}

                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <form method="post" action="{{route('userorgmngmnt')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Select asterick</label>
                                                    <select class="form-control" name="firstselectbox" onchange="this.form.submit()">
                                                        <option selected="" value="">*</option>
                                                        <option value="1"    @if ("1" == $firstselectbox) selected @endif>1</option>
                                                        <option value="2"    @if ("2" == $firstselectbox) selected @endif>2</option>
                                                        <option value="off"  @if ("off" == $firstselectbox) selected @endif>A</option>
                                                        <option value="M"    @if ("M" == $firstselectbox) selected @endif>M</option>
                                                        <option value="NM"   @if ("NM" == $firstselectbox) selected @endif>NM</option>
                                                        <option value="S"    @if ("S" == $firstselectbox) selected @endif>S</option>
                                                        <option value="T"    @if ("T" == $firstselectbox) selected @endif>Tw</option>
                                                        <option value="F"    @if ("F" == $firstselectbox) selected @endif>Fb</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Region</label>
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
                                                    <label>Select Year</label>
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
                                            <div class="col-md-1 col-lg-2">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <select class="form-control" name="age" onchange="this.form.submit()">
                                                        <option value="">Any</option>
                                                        <option value="plus"  @if ("plus" ==  $age) selected @endif>+</option>
                                                        <option value="minus" @if ("minus" ==  $age) selected @endif>-</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-2 mt-25">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="submit" class="btn bg-olive"><i class="fa fa-search"></i>
                                                        Find </button>
                                                    <a href="{{route('userorgmngmnt')}}" class="btn btn-primary"><i class="fa fa-list-ul"
                                                            aria-hidden="true"></i> All</a>
                                                </div>
                                            </div>
                                            @if($category!='')
                                            <div class="col-md-12">
                                                <div id="orgCatDropdown">
                                                    <div class="col-md-4">
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
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="companyname"
                                                        value="{{ !empty($companyname) ? $companyname : '' }}" placeholder="Search">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="searchid"
                                                        value="{{ !empty($searchid) ? $searchid : '' }}" placeholder="Search By Id">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                       <div class="col-xs-12">
                            <div class="box">
                                
                                <div class="box-body table-responsive no-padding tbl-border">
                                    <table class="table table-hover">
                                        <thead class="thead-bg">
                                            <tr>
                                                <th></th>
                                                <th>FA</th>
                                                <th>Name</th>
                                                <th>ID</th>
                                                <th>Login</th>
                                                <th colspan="2">Paid</th>
                                                <th>Age</th>
                                                <th colspan="2">Contact</th>
                                            </tr>
                                        </thead>
                                                              <tbody>
                                        @php 
                                            $current_state = null;
                                            $current_city = null;
                                            foreach ($response as $datas){
                                            $state_name =  $datas->Description;
                                            $city_name = $datas->CatagoryName;
                                            if($state_name != $current_state) {
                                            $current_state = $state_name;
                                        @endphp
                                           
                                                <tr class="table-name reason-bg" style="background-color:#263102; color:#fff;">
                                                    <td colspan="10" value="">{{@$state_name}}</td>
                                                </tr>
                                        @php 
                                                } if($city_name != $current_city) {
                                                    $current_city = $city_name;
                                        @endphp  
                                                    <tr class="table-name">
                                                        <td colspan="10" value="">{{@$city_name}}</td>
                                                    </tr>
                                                    <tr>
                                        @php 
                                                }
                                        @endphp
                                            <td style="width:6%"><?php if(@$datas->DefaultNotifyTwitter!=0){ ?><a href=""><i class="fa fa-twitter-square fa-lg"></i></a><?php } if(@$datas->DefaultNotifyFacebook!=0){?> <a href=""><i class="fa fa-fw fa-facebook-square fa-lg"></i></a> <?php } ?></td>
                                                <?php 
                                            $count=Helper::getDataID1('publicusersubscription',$datas->OrgID,'OrgID');
                                            ?>
                                            <td class="text-nowrap"><?php  if(count($count)){echo count($count);} ?> <span> <?php 
                                                $deviceCount = 0;
                                            foreach($count as $counts){
                                                $device=Helper::getDataID1('publicuserdevice',$counts->PublicUserID,'PublicUserID'); 
                                                $deviceCount += count($device);
                                            }
                                            if($deviceCount){
                                            ?>
                                                (<?php echo $deviceCount; ?>)
                                                <?php
                                            }?>
                                            </span></td>
                                            <td value="">
                                           
                                            <a href="@if($datas->OrgID!=''){{url('ids/' . $datas->OrgID)}}@endif" target="_blank"><b>{{@$datas->Name}}</b></a>
                                            <?php
                                            $suborg=Helper::getSubOrg($datas->OrgID);
                                            //echo '<pre>';
                                            //print_r($suborg);
                                            if($suborg!=''){
                                            ?>
                                             @foreach($suborg as $suborgs)
                                              <div style="padding-top:16px;"><a href="@if($datas->OrgID!=''){{url('ids/' . $suborgs->id)}}@endif" target="_blank" style="margin-left:15px;">{{@$suborgs->Name}}</a></div>
                                             @endforeach
                                             <?php } ?>
                                            </td>
                                            <td value="">{{@$datas->OrgID}}
                                            <?php
                                             if($suborg!=''){
                                             ?>
                                             @foreach($suborg as $suborgs)
                                              <div style="padding-top:16px;">{{@$suborgs->id}}</div>
                                             @endforeach
                                             <?php } ?>
                                             </td>
                                            <td value="">{{@$datas->UserName}}</td>
                                            <td value="">
                                            @php
                                                $date = @$datas->DateLastPaid;
                                                $year = substr($date, 0, 4);
                                                //$output = ($year === '0000') ? 'Never' : $year;
                                                if($year === '0000' || $datas->AmountPaid==''){
                                                    $output="Never";
                                                }else{
                                                    $output=$year.'  '.$datas->AmountPaid.'$';  
                                                }
                                            @endphp
                                            {{ $output }}
                                            </td>
                                            @php
                                                $currentDate = \Carbon\Carbon::now();
                                                $targetDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datas->DateUpdated);
                                                $monthDifference = $currentDate->diffInMonths($targetDate)+1;
                                            @endphp
                                            <td value="">
                                            {{@$monthDifference}}
                                            </td>
                                            <td class="text-nowrap"><a href="">{{$datas->PrimaryName}}</a>
                                            </td>
                                            <td>
                                            @if(!empty($datas->PrimaryWorkEmail))
                                                <a href="" class="outline-btn" data-toggle="tooltip" data-placement="top" title="{{$datas->PrimaryWorkEmail}}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{url('IIN/orginform/' . base64_encode($datas->OrgID))}}" class="outline-btn"> Edit</a>
                                                <?php
                                                if($suborg!=''){
                                                ?>
                                                @foreach($suborg as $suborgs)
                                                <div><a href="{{url('IIN/orginformsub/' . base64_encode($suborgs->id))}}" class="outline-btn mt-2"> Edit</a></div>
                                                @endforeach
                                                 <?php } ?>

                                            </td>
                                        </tr>
                                        @php 
                                                }
                                        @endphp
                                        </tbody>
                                    </table>
                                    {{ $response->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
        <script>
    function updateOrgCatSelect() {
        document.getElementById("orgCatSelect").selectedIndex = 0; // Reset orgCatSelect to the first option
        document.getElementById("orgCatSelect").onchange();
    }
     </script>  
    
   
@endsection