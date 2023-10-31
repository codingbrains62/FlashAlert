@php
$data1 = Helper::regioncrud();
$zone = Helper::timezone();
@endphp
@extends('backend.layouts.backapp')
@section('title', 'Region')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Region
            <!-- <small>Preview</small> -->
        </h1>
        <ol class="breadcrumb fw-6 font-14">
            <li>
                <a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Region</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <form role="form" method="post" action="{{ route('add.region') }}">
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
                                <input type="hidden" name="hidden" value="{{@$dataRegion[0]->id}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" placeholder="Enter Description"
                                            name="Description"
                                            value="@if (isset($dataRegion[0])) {{ str_replace('/', '-', $dataRegion[0]->Description) }} @endif"
                                             />
                                    </div>
                                     @error('Description')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                     @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time Zone</label>
                                        <select class="form-control" name="timezone" >
                                            <option value="">Select</option>
                                            @foreach ($zone as $zones)
                                            <option value="{{ $zones->zid }}" @if (isset($dataRegion[0])) {{ $zones->zid
                                                == $dataRegion[0]->ZoneID ? 'selected' : '' }} @endif>
                                                {{ $zones->TimeZone }}-{{$zones->Comments}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     @error('timezone')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                     @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" placeholder="Enter Website"
                                            name="website"
                                            value="@if (isset($dataRegion[0])) {{ str_replace('/', '-', $dataRegion[0]->SiteURL) }} @endif"
                                             />
                                    </div>
                                     @error('website')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                     @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="state">
                                            <option value="">Select</option>
                                            <option value="CO" @if (isset($dataRegion[0])) {{$dataRegion[0]->State == 'CO' ? 'selected' : '' }} @endif>CO</option>
                                            <option value="ID" @if (isset($dataRegion[0])) {{$dataRegion[0]->State == 'ID' ? 'selected' : '' }} @endif>ID</option>
                                            <option value="OR" @if (isset($dataRegion[0])) {{$dataRegion[0]->State == 'OR' ? 'selected' : '' }} @endif>OR</option>
                                            <option value="WA" @if (isset($dataRegion[0])) {{$dataRegion[0]->State == 'WA' ? 'selected' : '' }} @endif>WA</option>
                                        </select>
                                    </div>
                                     @error('state')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                     @enderror
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" placeholder="Enter State" name="state"
                                            value="@if (isset($dataRegion[0])) {{ str_replace('/', '-', $dataRegion[0]->State) }} @endif"
                                             />
                                    </div>
                                     @error('state')
                                        <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                     @enderror
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="checkbox mt-0">
                                        <label>    
                                            <input type="checkbox" name="tier2" value="1" @php if(isset($dataRegion[0])){
                                                    echo (($dataRegion[0]->Tier2Enabled)==1 ? 'checked' : '');} @endphp />
                                                Tier 2 Enabled
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox mt-0">
                                        <label>    
                                            <input type="checkbox" name="memerg" value="1" @php if(isset($dataRegion[0])){
                                                    echo (($dataRegion[0]->BundleEmergencies)==1 ? 'checked' : '');} @endphp />
                                                Bundle Emergencies
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer row">
                                <!-- <button type="submit" class="btn btn-primary">
                                                Submit
                                                </button> -->
                                @if (isset($dataRegion[0]))
                                
                                <button type="submit" class="btn btn-success col-xs-5 col-md-2"><i class="fa fa-fw fa-upload"></i> Update</button>
                                <a href="{{ route('region.data') }}" class="btn btn-danger col-xs-5 col-md-2 mx-3"><i class="fa fa-fw fa-close"></i> Cancel</a>
                                @else
                                <button type="submit" class="btn btn-success col-xs-12 col-sm-3 col-md-2"><i class="fa fa-fw fa-plus"></i> Add</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!--   </section>
    <section class="content"> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="bg-grey-lite">
                                <tr>
                                    <th scope="col">Description</th>
                                    <th scope="col">Time Zone</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Tier2 </th>
                                    <th scope="col">15m Emerg</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="fw-6 v-align-mid">
                                @foreach ($data1 as $datas)
                                <tr>
                                    <td>{{ ucwords(str_replace('/', '-', $datas->Description)) }}</td>
                                    <td>{{ $datas->TimeZone }}-{{$datas->Comments}}</td>
                                    <td>{{ $datas->SiteURL }}</td>
                                    <td>{{ $datas->State }}</td>
                                    <td> @php echo (($datas->Tier2Enabled==1) ? 'Y' : ''); @endphp</td>
                                    <td> @php echo (($datas->BundleEmergencies==1) ? '15min' : '1min'); @endphp</td>
                                    <td class="d-flex">
                                        <a href="{{ url('IIN/edit-region/'.$datas->id) }}"  data-toggle="tooltip" title="Edit"
                                            class="btn btn-social-icon cst-edit"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="delete-region/{{ $datas->id }}" data-toggle="tooltip" title="Delete" class="btn btn-social-icon cst-del"
                                            onclick="return confirm('Are you sure you want to delete this region?')"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {{ $data1->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>



<script>
        
        function showConfirmDialog1(event) {
    event.preventDefault(); // Prevents the default behavior of the anchor tag

    console.log('Delete URL:', event.target.href); // Debug statement

    swal({
        title: "Are you sure?",
        text: "This action cannot be undone.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            // Redirect to the specified URL
            window.location.href = event.target.href;
        }
    });
}

    </script>
@endsection