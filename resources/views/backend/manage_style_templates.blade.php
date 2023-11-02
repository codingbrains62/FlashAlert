@php
//echo '<pre>';
//print_r($data);
//die;
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Style Templates')
@section('content')
<style>
    a:hover {
       text-decoration:underline;
    }
    .content {
    min-height: 0px;
    padding: 10px;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}
.cst-del .fa {
    color: #c76969;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Style Templates
            <!-- <small>Preview</small> -->
        </h1>
        <ol class="breadcrumb fw-b font-14">
            <li>
                <a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Style Templates</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <form role="form" method="post" action="{{ route('add.style.temp') }}" id="styleForm">
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
                               
                                <div class="col-md-6">
                                    <input type="hidden" name="hidden" value="{{@$result[0]->id}}">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name"
                                            name="Name"
                                            value="{{@$result[0]->Name}}"
                                             />
                                    </div>
                                      @error('Name')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                      @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" class="form-control" placeholder="Enter URL" name="URL"
                                            value="{{@$result[0]->URL}}"
                                             />
                                    </div>
                                    @error('URL')
                                    <span style="color:red;" role="alert"><strong>{{str_replace(' u r l',' Url ' ,$message)  }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer row">
                                @if(isset($result))
                                <button type="submit" class="btn btn-info col-xs-5 col-md-2"><i class="fa fa-fw fa-upload"></i>Update</button>
                                <a href="{{route('style.templates')}}" class="btn btn-danger col-xs-5 col-md-2 mx-2"><i class="fa fa-fw fa-close"></i> Cancel</a>
                                @else
                                <button type="submit" class="btn btn-success col-xs-12 col-sm-3 col-md-2"><i class="fa fa-fw fa-plus"></i> Add</button>
                                @endif
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Counts</th>
                                </tr>
                            </thead>
                            <tbody class="fw-6 v-align-mid">
                                @php 
                                $current_state = null;
                                @endphp
                                @foreach($data as $datas)
                                @php
                                $data1 = explode(':', $datas->Name);
                                if(count($data1)==3){
                                $name = $data1[0] . ':' . $data1[1]. ':';
                                }else{
                                $name = $data1[0] . ':';  
                                }
                                @endphp
                                    <tr>
                                     @php 
                                       if($name!= $current_state) {
                                        $current_state = $name;
                                       @endphp
                                        <td colspan='4' class="bg-grey-lite">
                                      
                                       <b>{{$name}}</b> 
                                      
                                        </td>
                                        @php 
                                       }
                                       @endphp
                                    </tr>
                                    <tr>
                                        <td class="fw-6">
                                           @if(isset($data1[2]))
                                           {{$data1[2]}}
                                           @elseif(isset($data1[1]))
                                           {{$data1[1]}}
                                           @else
                                           {{$data1[0]}}
                                           @endif
                                        </td>
                                        <td><a href="{{$datas->URL}}">{{$datas->URL}}</a></td>
                                        <td class="fw-6">2</td>
                                        <td class="d-flex">
                                        {{-- <a href="{{url('IIN/styletempdel/' . base64_encode($datas->id))}}" class="outline-btn"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                        <a href="{{url('IIN/styletempedit/' . base64_encode($datas->id))}}"class="btn btn-social-icon cst-edit" data-toggle="tooltip" title="Edit" ><i class="fa fa-fw fa-edit"></i></a>
                                        {{-- <a href="{{url('IIN/styletempdel/' . base64_encode($datas->id))}}" class="btn btn-social-icon cst-del" data-toggle="tooltip" title="Delete" onclick="return showConfirmDialog(event)"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                        <a href="{{url('IIN/styletempdel/' . base64_encode($datas->id))}}" class="btn btn-social-icon cst-del" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function deleteData() {
    var confirmed = confirm('Are you sure you want to delete?');
    if (confirmed) {
        // Perform the deletion action here
        // This is where you would put your code to delete the data
        alert('Data deleted successfully.');
    } else {
        // The user clicked "Cancel," no data is deleted
        alert('Deletion canceled.');
    }
}

    // function showConfirmDialog(event) {
    //     var result = confirm("Are you sure you want to delete this item?");
    //     if (result) {
    //         // The user clicked "OK" in the confirmation dialog, proceed with the deletion
    //         return true;
    //     } else {
    //         // The user clicked "Cancel" in the confirmation dialog, cancel the deletion
    //         event.preventDefault(); // Prevent the default link behavior
    //         return false;
    //     }
    // }
</script>

@endsection