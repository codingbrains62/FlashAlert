@php 
//echo '<pre>';
//print_r($response);
//die;
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Station/Recipients')
@section('content')
<style>
 .pagination-info {
  font-family: Arial, sans-serif;
  font-size: 16px;
  color: #333;
  margin:10px;
}

.current-page {
  font-weight: bold;
  color: #ff0000; / red /
}

.first-item,
.last-item,
.total {
  font-weight: bold;
  color: #0000ff; / blue /
}
</style>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
            Station/Recipients
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Station/Recipients</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
               
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- </div> --}}
                    <div class=" ">

                        {{-- main data tables  --}}

                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-2"><a href="{{route('station.page')}}" class="btn btn-success">Add New</a></div>
                                            <div class="col-md-6">
                                            <form method="post" action="{{route('station.recipiant')}}">
                                             @csrf
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
                                                <div class="alert alert-danger alert-dismissible fade show">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                    {{ Session::get('failed') }}
                                                </div>
                                                @endif
                                                <div class="form-group">
                                                    <label>Select Region</label>
                                                    <select class="form-control" id="regionDropdown" name="region" onchange="this.form.submit()">
                                                        <option value="">All</option>
                                                            @foreach($data as $datas)
                                                            <option value="{{ $datas->id }}"  @if ($datas->id == $selectedRegion) selected @endif>{{$datas->Description}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
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
                                                        <option value="never" @if ("never" == $amountpaid) selected @endif>Never</option>
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-25">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="submit" class="btn bg-olive"><i class="fa fa-search"></i>
                                                        Find </button>
                                                    <a href="{{route('station.recipiant')}}" class="btn btn-primary"><i class="fa fa-list-ul"
                                                            aria-hidden="true"></i> All</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="companyname"
                                                        value="{{ !empty($companyname) ? $companyname : '' }}" placeholder="Search Here">
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
                                    @if ($response->isEmpty())
                                        <p>No data found for the selected.</p>
                                    @else
                                    <table class="table table-hover">
                                        <thead class="thead-bg">
                                            <tr>
                                                <th colspan='2'>Name</th>
                                                <th colspan='2'>Updated Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php 
                                            $current_state = null;
                                            $current_city = null;
                                            foreach ($response as $datas){
                                            $state_name =  $datas->Description;
                                            $city_name = $datas->CityCode;
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
                                                    <tr class="table-name reason-bg" style="background-color:#fffggg;">
                                                        <td colspan="10" value=""><b>{!!@$city_name!!}</b></td>
                                                    </tr>
                                                    <tr>
                                        @php 
                                            }
                                        @endphp
                                        <tr>
                                            <td style="width:75%">{{@$datas->Name}}<br>
                                            <span style="margin-left:15px;">{{@$datas->ContactInfo}}</span>

                                            </td>
                                            <td value="">{{@$datas->DateVerified}}</td>
                                            <td value="">
                                                <?php
                                                $count=Helper::getDataID1('subemail',$datas->id,'SubID');
                                                ?>
                                                {{count($count)}}
                                            </td>
                                            <td value=""> <a href="{{url('IIN/req-update/'.base64_encode(@$datas->id))}}" class="outline-btn">Req.Update</a>
                                                     <a href="{{url('IIN/edit-station/'.base64_encode(@$datas->id))}}" class="outline-btn"><i class="fa fa-pencil-square-o"></i> Edit</a></td>
                                        </tr>
                                        @php 
                                            }
                                        @endphp
                                        </tbody>
                                       
                                    </table>


                                    <div class="pagination-info">
                                      Page <span class="current-page">{{$response->currentPage()}}</span> - Showing <span class="first-item">{{$response->firstItem()}}</span> to <span class="last-item">{{$response->lastItem()}}</span> of <span class="total">{{$response->total()}}</span>
                                    </div>
                                    @endif
                                    <!-- {{$response->firstItem()}} To {{$response->lastItem()}} Of {{$response->total()}} -->
                                    <!-- {{ $response->appends(request()->except('page'))->links() }} -->
                                    {{ $response->appends(request()->except('page'))->onEachSide(1)->links() }}
                                    <!-- <a href="{{ $response->url(1) }}" class="page-link">&laquo;</a>  {{ $response->appends(request()->except('page'))->onEachSide(1)->links() }} <a href="{{ $response->url($response->lastPage()) }}" class="page-link"> &raquo;</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
      
    
   
@endsection