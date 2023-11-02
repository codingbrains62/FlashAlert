@extends('backend.layouts.backapp')
@section('title', 'Add new user')
@section('content')
<style>
    .adity{
    margin-left:auto;
    height: auto;
    min-height: 100%;
    }
</style>
<div class="content-wrapper @unless(Session::has('loginId'))adity @endunless">
    <section class="content-header">
        <h1>
            FlashAlert Signup
            <small></small>
        </h1>
        <ol class="breadcrumb font-14 fw-6">
            <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">FlashAlert Signup :</li>
        </ol>
    </section>
    <section class="content ">
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ Session::get('failed') }}
            </div>
            @endif
            <form method="get" action="{{ route('post.newuser') }}">
                @csrf
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="info-box box-body">
                        <h4 class="bg-info p-3">FlashAlert Signup</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Please select your region:</label>
                                    <select class="form-control" id="getnewuserregion" name="getnewuserregion" required>
                                        <option value="">Select</option>
                                        @foreach($data as $datas)
                                        <option value="{{ $datas->id }}" @if(session::get('RegionID')==$datas->id) selected @endif>{{ $datas->Description }}</option>
                                        @endforeach
                                    </select>
                                    @error('getnewuserregion')
                                    <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                @unless (Session::has('loginId'))
                                <div>
                                    <font face="Verdana" size="2">If you are already a FlashAlert user, click here to <b><a href="{{ route('backend.signin') }}">update your account</a></b>.</font>
                                </div>
                                @endunless
                                <input type="submit" name="next" value="Next" class="btn btn-success col-md-3 col-xs-4">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection