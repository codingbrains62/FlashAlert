@php 
//echo '<pre>';
// print_r($orgcat);
 //die;
if(isset($dataRegion[0])){
$region=Helper::getData('regions',$dataRegion[0]->RegionID,'','');
}
@endphp
@extends('backend.layouts.backapp')
@section('title','Organization category')
@section('content')
<style>
    input[type='number']{
    width: 50px;
} 
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Organization
            <!-- <small>Preview</small> -->
        </h1>
        <ol class="breadcrumb fw-bold font-14">
            <li>
                <a href="{{url('/IIN/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Organization</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <form role="form" method="post" action="{{route('add.org')}}">
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {{ Session::get('failed') }}
                                </div>
                                @endif
                                <input type="hidden" name="hidden" value="{{@$dataRegion[0]->id}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Region</label>
                                    <select class="form-control" name="region" id="region" >
                                        {{-- <option value="">All</option> --}}
                                        @if(isset($dataRegion[0]))
                                        <option value="{{@$region[0]->id}}" selected>{{ ucwords(str_replace('/', '-', @$region[0]->Description)) }}</option>
                                        @endif
                                        @foreach ($orgcat as $key => $catorg)
                                        @if ($key == 0 || $catorg->region_description != $orgcat[$key - 1]->region_description)
                                        <option value="{{@$catorg->region_id}}">{{ ucwords(str_replace('/', '-', @$catorg->region_description)) }}</option>
                                        @endif
                                       @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rank</label>
                                        <input type="text" class="form-control" placeholder="Enter Rank" name="rank" value="{{@$dataRegion[0]->Rank}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Org Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Org name" name="name" value="{{@$dataRegion[0]->CatagoryName}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fee</label>
                                        <input type="text" class="form-control" placeholder="Enter fee" name="fee" value="{{@$dataRegion[0]->Fee}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox mt-0">
                                        <label>    
                                            <input type="checkbox" name="tier2" value="1" @php if(isset($dataRegion[0])){ echo (($dataRegion[0]->SchoolRelated)==1 ? 'checked' : '');} @endphp/>
                                         School</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox mt-0">
                                    <label>
                                        <input type="checkbox" name="memerg" value="1" @php if(isset($dataRegion[0])){ echo (($dataRegion[0]->Tier2Enabled)==1 ? 'checked' : '');} @endphp/>
                                        Tier 2
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer row">
                                <!-- <button type="submit" class="btn btn-primary">
                                Submit
                                </button> -->
                                @if(isset($dataRegion[0]))
                                <button type="submit" class="btn btn-info col-xs-5 col-md-2"><i class="fa fa-fw fa-upload"></i> Update</button>
                                <a href="{{route('org.data')}}" class="btn btn-danger col-xs-5 col-md-2 mx-3"><i class="fa fa-fw fa-close"></i> Cancel</a>
                                @else
                                <button type="submit" class="btn btn-success col-xs-12 col-sm-3 col-md-2"><i class="fa fa-fw fa-plus"></i> Add</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- </section>
    <section class="content"> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <div id="showcategory"></div>
                        <div id="showall">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr> 
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Fee</th>
                                <th>School</th>
                                <th>Tier 2</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="v-align-mid fw-6">
                            @php
                            $state=Helper::cityData('regions','','Description','asc',2)
                            @endphp
                            @foreach ($state as $key => $states)
                            <tr>
                                <th colspan="7" class="bg-grey-lite">{{ ucwords(str_replace('/', '-', $states->Description)) }}</th>
                            </tr>
                            @php
                            $city=Helper::cityData('orgcats',$states->id,'Rank','desc')
                            @endphp
                            @foreach($city as $cities)
                            <tr>
                                <td class="td-btn text-nowrap">
                                    <input class="min-length-orgrank fw-6" readonly value="{{ $cities->Rank }}"/>
                                        <form action="{{ route('orgoptions.increase-rank', $cities->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" data-toggle="tooltip" title="Increase"  class="btn-increment plus"><i class="fa fa-fw fa-plus"></i></button>
                                        </form>
                                        <form action="{{ route('orgoptions.decrease-rank', $cities->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" data-toggle="tooltip" title="Decrease"  class="btn-increment minus"><i class="fa fa-fw fa-minus"></i></button>
                                        </form>
                                </td>
                                <td>{!! $cities->CatagoryName !!}</td>
                                <td>{{ $cities->Fee }}</td>
                                <td> @php echo (($cities->SchoolRelated==1) ? 'Y' : ''); @endphp</td>
                                <td> @php echo (($cities->Tier2Enabled==1) ? 'Y' : ''); @endphp</td>
                                <td class="d-flex">
                                    <a href="{{url('IIN/edit-org/'.$cities->id)}}" class="btn btn-social-icon cst-edit scrollToTopButton" data-toggle="tooltip" title="Edit" ><i class="fa fa-fw fa-edit"></i></a>
                                    {{-- <a style="margin-left:3px"href="{{url('IIN/delete-org/'.$cities->id)}}" class="btn btn-social-icon cst-del" data-toggle="tooltip" title="Delete"  onclick="showConfirmDialog(event)"><i class="fa fa-trash"></i></a> --}}
                                    <a style="margin-left:3px"href="{{url('IIN/delete-org/'.$cities->id)}}" class="btn btn-social-icon cst-del" data-toggle="tooltip" title="Delete"  onclick="return confirm('Are you sure you want to delete this ?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                        {{$state->links()}}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection