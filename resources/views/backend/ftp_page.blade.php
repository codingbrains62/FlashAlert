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
  color: #ff0000; /* red */
}

.first-item,
.last-item,
.total {
  font-weight: bold;
  color: #0000ff; /* blue */
}
</style>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
            Station/Recipients
                <small></small>
            </h1>
            <ol class="breadcrumb font-14 fw-6">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Station/Recipients</li>
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
        <section class="content">
            <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <a href="{{route('station.recipiant')}}" class="btn btn-info"><i class="fa fa-fw fa-chevron-left mx-1"></i> BACK</a>
                                            </div>
                                            <div class="col-md-6">
                                            <form method="post" action="{{route('add.ftp')}}">
                                             @csrf
                                             <input type="hidden" name="hidden" value="{{@$dataRegion[0]->id}}">
                                              <input type="hidden" name="SubID" value="{{@$id}}">
                                                <div class="form-group">
                                                    <label>Template Style:</label>
                                                    <select class="form-control" id="styleID" name="styleID">
                                                        <option value="">Select</option>
                                                            @foreach($data as $datas)
                                                            <option value="{{ $datas->id }}" @if (isset($dataRegion[0])) {{ $datas->id
                                                           == $dataRegion[0]->StyleID ? 'selected' : '' }} @endif>{{$datas->Name}}</option>
                                                            @endforeach
                                                    </select>
                                                    @error('styleID')
                                                        <span style="color:red;" role="alert"><strong>{{ str_replace("style i d","Template Style",$message) }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label>FTP Address</label>
                                                    <input type="text" name="Address" class="form-control" value="{{@$dataRegion[0]->Address}}">  
                                                     @error('Address')
                                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                                     @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>FTP Login/Username</label>
                                                    <input type="text" name="Username" class="form-control" value="{{@$dataRegion[0]->Username}}">
                                                   @error('Username')
                                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                                   @enderror
                                                </div>
                                                 
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>FTP Password</label>
                                                    <input type="text" name="Password" class="form-control" value="{{@$dataRegion[0]->Password}}">
                                                    @error('Password')
                                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>File Path: Example: /directory/school_closures.html:</label>
                                                    <input type="text" name="FilePath" class="form-control" value="{{@$dataRegion[0]->FilePath}}">
                                                    @error('FilePath')
                                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group mt-25">
                                                    
                                                  <input type="checkbox" name="ActiveMode" value="1" @php  if(isset($dataRegion[0])){ echo (($dataRegion[0]->ActiveMode )==1 ? 'checked' : '');} @endphp>
                                                  <lable>Send FTP in Active (Non-Passive) mode.</lable>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                  <label>Delivery Protocol</label>
                                                    <select class="form-control" id="regionDropdown" name="Method">
                                                        <option value="FTP" @if(isset($dataRegion[0]) && "FTP" == $dataRegion[0]->Method) selected @endif>FTP</option>
                                                    <option value="SFTP" @if(isset($dataRegion[0]) && "SFTP" == $dataRegion[0]->Method) selected @endif>SFTP</option>
                                                    </select>
                                                    @error('Method')
                                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <div class="form-group">
                                                  @if(isset($dataRegion[0]))
                                                  <input type="submit" value="SAVE" class="btn btn-success col-xs-12 col-sm-3 col-md-2 mx-1">
                                                  <a href="{{route('station.recipiant')}}" class="btn btn-primary"> Cancel</a>
                                                  <a href="" class="btn btn-danger col-xs-12 col-sm-3 col-md-2 mx-1">Delete</a>
                                                  @else
                                                  <input type="submit" value="ADD" class="btn btn-success col-xs-12 col-sm-3 col-md-2 ">
                                                  @endif
                                                   
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
            </div>  
        </section>
     </div>
    
    
    
   
@endsection