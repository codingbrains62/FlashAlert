@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Report Submission
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Report Submission</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: initial;">
                    <div class=" ">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <form method="post" action="{{ route('closure.reports') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Select asterick</label>
                                                    <select class="form-control" name="firstselectbox"
                                                        onchange="this.form.submit()">
                                                        <option selected="" value="">All</option>
                                                        <option value="1"
                                                            @if ('1' == $firstselectbox) selected @endif>1</option>
                                                        <option value="2"
                                                            @if ('2' == $firstselectbox) selected @endif>2</option>
                                                        <option value="active"
                                                            @if ('active' == $firstselectbox) selected @endif>Active
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Region</label>
                                                    <select class="form-control" id="regionDropdown" name="region"
                                                        onchange="this.form.submit(),updateOrgCatSelect()">
                                                        <option value="">All Regions</option>
                                                        @foreach ($data as $datas)
                                                            <option value="{{ $datas->id }}"
                                                                @if ($datas->id == $selectedRegion) selected @endif>
                                                                {{ $datas->Description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($category != '')
                                                <div class="col-md-4" id="orgCatDropdown">
                                                            <div class="form-group">
                                                                <label>Select Organization Category</label>
                                                                <select class="form-control" id="orgCatSelect"
                                                                    name="orgCatSelect" onchange="this.form.submit()">
                                                                    <option value="">All</option>
                                                                    @foreach ($category as $categories)
                                                                        <option value="{{ $categories->id }}"
                                                                            @if ($categories->id == $selectedorgcat) selected @endif>
                                                                            {{ $categories->CatagoryName }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                </div>
                                            @endif
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
                                                <th>Org</th>
                                                <th>Note</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-6">
                                            <?php
                                                $current_state = null;
                                                $current_city = null;
                                                foreach ($response as $datas){
                                                $state_name =  $datas->Description;
                                                $city_name = $datas->CatagoryName;
                                                if($state_name != $current_state) {
                                                $current_state = $state_name;
                                            ?>
                                            <tr class="bg-grey-lite reason-bg" style="background-color:#263102; color:#fff;">
                                                <td colspan="10" value="">{{ @$state_name }}</td>
                                            </tr>
                                            <?php
                                            }
                                            if ($city_name != $current_city) {
                                            $current_city = $city_name;
                                            ?>
                                            <tr class="bg-grey-lite">
                                                <td colspan="10" value="">{{ @$city_name }}</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                }
                                               ?>
                                                <td value=""><span>{{ @$datas->Name }}</span>
                                                    <?php
                                                $suborg = Helper::getSubOrg($datas->OrgID);
                                                if ($suborg != "") { 
                                                ?>
                                                    @foreach ($suborg as $suborgs)
                                                        <div class="mt-22">
                                                            <span style="margin-left:15px;"><span style="color:#CCC;">└
                                                                </span>&nbsp;{{ @$suborgs->Name }}</span>
                                                        </div>
                                                    @endforeach
                                                    <?php  }  ?>
                                                </td>
                                                <td value="">{{ @$datas->report_notes }}</td>
                                                <td value="">{{ @$datas->report_effective_date }}</td>
                                                <td class="text-nowrap" style="">
                                                    @if ($datas->report_notes)
                                                        <a href="{{ url('edit-link') }}" class="btn btn-info">Edit</a>
                                                    @else
                                                        {{-- Replace 'edit-link' with the URL for the edit action if needed --}}
                                                        <a href="{{ url('IIN/closureemergmess-' . base64_encode($datas->OrgID)) }}"
                                                            class="btn btn-success my-1 mx-1">Add</a>
                                                    @endif
                                                    <a href="{{ url('IIN/closuresendmessage-' . base64_encode($datas->OrgID)) }}"
                                                    class="btn btn-warning my-1 mx-1">Email</a>
                                                    @if ($datas->report_notes)
                                                        <a href="{{ url('delete-link') }}" class="btn btn-danger my-1 mx-1">Delete</a>
                                                    @endif
                                                    <br>
                                                    @if ($suborg != '')
                                                        @foreach ($suborg as $suborgs)
                                                            @if ($datas->report_notes)
                                                                <a href="{{ url('edit-link') }}" class="btn btn-info my-1 mx-1">Edit</a>
                                                            @else
                                                                {{-- Replace 'edit-link' with the URL for the edit action if needed --}}
                                                                <a href="{{ url('IIN/closureemergmess-' . base64_encode($suborgs->id)) }}"
                                                                class="btn btn-success my-1 mx-1">Add</a>
                                                            @endif
                                                            <a href="{{ url('IIN/closuresendmessage-' . base64_encode($suborgs->id)) }}"
                                                                class="btn btn-warning my-1 mx-1">Email</a>
                                                            @if ($datas->report_notes)
                                                                <a href="{{ url('delete-link') }}"
                                                                    class="btn btn-danger my-1 mx-1">Delete</a>
                                                            @endif
                                                            <br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            <?php if(count($response)<1){ ?>
                                            <tr>
                                                <td colspan="4"><strong> No reports to display currently.</strong></td>
                                            </tr>
                                            <?php } ?>
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
