@php 
if(isset($dataRegion[0])){
$region=Helper::getData('regions',$dataRegion[0]->RegionID,'','');
}
@endphp

@extends('backend.layouts.backapp')
@section('title','City')
@section('content')
<style>
    .cst-del .fa {
    color: #c76969;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            City
            <!-- <small>Preview</small> -->
        </h1>
        <ol class="breadcrumb fw-bold font-14">
            <li>
                <a href="{{url('/IIN/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">City</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <form role="form" method="post" action="{{route('add.city')}}">
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
                            <input type="hidden" name="hidden" value="{{@$dataRegion[0]->cid}}">
                              <div class="col-md-6">
                                <div class="form-group">
                                <label>Regions</label>
                                    <select class="form-control" name="Description">
                                    @foreach ($orgcat as $key => $catorg)
                                        @if(isset($dataRegion[0]))
                                        <option value="{{@$region[0]->id}}">{{ ucwords(str_replace('/', '-', @$region[0]->Description)) }}</option>

                                        @endif
                                        @if ($key == 0 || $catorg->Description != $orgcat[$key - 1]->Description)
                                        <option value="{{@$catorg->id}}">{{ ucwords(str_replace('/', '-', @$catorg->Description)) }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rank</label>
                                    <input type="text" class="form-control" placeholder="Enter Rank" name="rank" value="{{@$dataRegion[0]->CityRank}}" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label>City Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="cityname" value="{{@$dataRegion[0]->CityName}}" required/>
                                </div>
                              </div>
                             
                              <div class="col-md-6">
                                <div class="form-group" style="margin-top:6%;">
                                <input type="checkbox"  name="dcity" value="1" @php  if(isset($dataRegion[0])){ echo (($dataRegion[0]->DefaultCity )==1 ? 'checked' : '');} @endphp/>
                                <label>Default</label>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer row">
                                <!-- <button type="submit" class="btn btn-primary">
                                Submit
                                </button> -->
                                @if(isset($dataRegion[0]))
                                <button type="submit" class="btn btn-info col-xs-5 col-md-2"><i class="fa fa-fw fa-upload"></i> Update</button>
                                <a href="{{route('city.data')}}" class="btn btn-danger col-xs-5 col-md-2 mx-3"><i class="fa fa-fw fa-close"></i> Cancel</a>
                                @else
                                <button type="submit" class="btn btn-success col-xs-12 col-sm-3 col-md-2"><i class="fa fa-fw fa-plus"></i> Add</button>
                                @endif
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
   <!--  </section>
    <section class="content"> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover v-align-mid">
                             @php 
                             $state=Helper::cityData('regions','','Description','asc')

                             @endphp
                               @foreach ($state as $key => $states)
                                            <tr>
                                                <th class="bg-grey-lite" colspan="5">{{ ucwords(str_replace('/', '-', $states->Description)) }}</th>
                                            </tr>
                                @php 
                                $city=Helper::cityData('regioncities',$states->id,'CityRank','asc')
                                @endphp
                                @foreach($city as $cities)
                                        <tr>
                                        <td>
                                    
                                            </td>
                                                                             
                                            <td ><span class="txt-red fw-6">{!! $cities->CityName !!}</span>@if($cities->DefaultCity ==1 ) (default) @endif</td>
                                            <td><span class="txt-red fw-6">{{ $cities->CityRank }}</span></td>
                                            <td class="d-flex justify-center">
                                                <a href="{{url('IIN/edit-city/'.$cities->cid)}}" data-toggle="tooltip" title="Edit" class="btn btn-social-icon cst-edit"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                                        <a href="{{url('IIN/delete-city/'.$cities->cid)}}" data-toggle="tooltip" title="Delete" class="btn btn-social-icon cst-del"
                                                            onclick="confirm('Are you sure you want to delete ?')"><i
                                                                class="fa fa-trash"></i></a>
                                                {{-- <a href="{{url('IIN/delete-city/'.$cities->cid)}}" data-toggle="tooltip" title="Delete" class="btn btn-social-icon cst-del"
                                                    onclick="showConfirmDialog(event)"><i
                                                        class="fa fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                        
                                @endforeach 
                                @endforeach
                        </table>
                        {{$state->links()}}
                       
                    </div>

                </div>
            </div>

        </div>




    </section>
</div>



@endsection