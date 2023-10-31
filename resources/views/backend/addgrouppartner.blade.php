@php 
//echo '<pre>';
//print_r($response);
//die;
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Business Partner Group')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Business Partners Group
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Business Partners Group</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        @if(count($response)>0)
                        <div class="row"><div class="col-md-12 text-right"><a href="{{url('IIN/buninesspartner/'. base64_encode(@$response[0]->UserID))}}" class="btn btn-info">Back</a></div></div>
                        @else
                        <div class="row"><div class="col-md-12 text-right"><a href="{{url('IIN/buninesspartner/'. base64_encode(@$id))}}" class="btn btn-info">Back</a></div></div>

                        @endif
                        <form role="form" method="post" action="{{route('insert.group.partner')}}" id="myForm">
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
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    {{ Session::get('failed') }}
                                </div>
                                @endif
                                <input type="hidden" name="hidden" value="{{@$editgroup[0]->id}}">
                                <input type="hidden" name="UserID" value="{{@$id}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Name :</label>
                                        <input type="text" class="form-control" name="GroupName"
                                            value="{{@$editgroup[0]->GroupName }}"
                                             />
                                    @error('GroupName')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                     @enderror
                                    </div>
                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       @if(isset($editgroup[0]))
                                       <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                       <a href="{{url('IIN/addgrouppartner/'. base64_encode($editgroup[0]->UserID))}}"  class="btn btn-default">Cancel</a>
                                       @else
                                       <input type="submit" name="submit" value="Add" class="btn btn-success">
                                       @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(count($response)>0)
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table  table-hover">
                            <thead>
                            <tr style="background-color:#495A6D; color:#fff;">
                                    <th colspan="4">Group Name:</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($response as $datas)
                                <tr>
                                    <td colspan="3">{{ucwords(@$datas->GroupName) }}</td>
                                    <td colspan="1">
                                    <a href="{{url('IIN/editgrouppartner/'. base64_encode($datas->id))}}" class="btn btn-warning btn-xs">Edit</a>
                                    <a href="{{url('IIN/deletegrouppartner/'. base64_encode($datas->id))}}" class="btn btn-danger btn-xs" onclick="showConfirmDialog(event)">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div> 
@endsection