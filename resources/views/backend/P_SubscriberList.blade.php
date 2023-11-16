<style>
    .TableDivider {
        font-weight: bold;
        color: white;
        /* background: #627D4D; */
        background: #495A6D;
        /* padding: 5px 10px; */
    }
    ul.pagination{
        padding: 0 8px;
    }
</style>
@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            FlashAlert Subscriber Management
            <small></small>
        </h1>
        <ol class="breadcrumb fw-6 font-14">
            <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li class="active">Public Subscriber</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: initial;">
                {{-- </div> --}}
                <div class=" ">

                    {{-- main data tables  --}}

                    <div class="col-md-12">
                        <div class="box box-warning">
                            <div class="box-body">
                                <form method="post" action="{{route('psub_list')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Select</label>
                                                <select class="form-control" name="firstselectbox" onchange="this.form.submit()">
                                                    <option selected="" value="">*</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Select Region</label>
                                                <select class="form-control" id="regionDropdown" name="region" onchange="this.form.submit(),updateOrgCatSelect()">
                                                    <option value="">All</option>
                                                    @foreach($data as $datas)
                                                    <option value="{{ base64_encode($datas->id) }}" @if ($datas->id == $selectedRegion) selected @endif>{{$datas->Description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        @if($category!='')
                                        <div class="col-md-5">
                                            <div id="orgCatDropdown">
                                                    <div class="form-group">
                                                        <label>Select Organization Category</label>
                                                        <select class="form-control" id="orgCatSelect" name="orgCatSelect" onchange="this.form.submit()">
                                                            <option value="">All</option>
                                                            @foreach($category as $categories)
                                                            <option value="{{ base64_encode($categories->id) }}" @if ($categories->id == $selectedorgcat) selected @endif>{{$categories->CatagoryName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
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
                                            <th>Name</th>
                                            <th>Subscribers</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="v-align-mid fw-6">
                                        @php
                                        $current_state = null;
                                        $current_city = null;
                                        $shouldShowRegion = false;
                                        $shouldShowOrgCat = false;

                                        foreach ($response as $datas) {
                                        $state_name = $datas->Description;
                                        $city_name = $datas->CatagoryName;

                                        // Check if organization should be shown
                                        $shouldShowOrg = (isset($firstIdCounts[$datas->OrgID]) && $firstIdCounts[$datas->OrgID] !== 0 && $datas->Name != '');

                                        if ($shouldShowOrg) {
                                        // Show state name if it has changed
                                        if ($state_name != $current_state) {
                                        $current_state = $state_name;
                                        $current_city = null; // Reset the city name

                                        // Check if there is at least one organization category to show within the region
                                        $shouldShowOrgCat = false;
                                        foreach ($response as $categoryData) {
                                        if ($categoryData->Description == $state_name && isset($firstIdCounts[$categoryData->OrgID]) && $firstIdCounts[$categoryData->OrgID] !== 0 && $categoryData->CatagoryName != '') {
                                        $shouldShowOrgCat = true;
                                        break;
                                        }
                                        }
                                        // Display the region row if there is at least one organization category to show
                                        if ($shouldShowOrgCat) {
                                        $shouldShowRegion = true;
                                        @endphp
                                        <tr class="table-name reason-bg" style="background-color:#263102; color:#fff;">
                                            <td colspan="10" value="">{{ $state_name }}</td>
                                        </tr>
                                        @php
                                        }
                                        }
                                        // Show city name if it has changed
                                        if ($city_name != $current_city) {
                                        $current_city = $city_name;

                                        // Display the organization category row if there is at least one organization to show within that category
                                        $shouldShowOrgCat = false;
                                        foreach ($response as $categoryData) {
                                        if ($categoryData->Description == $state_name && $categoryData->CatagoryName == $city_name && isset($firstIdCounts[$categoryData->OrgID]) && $firstIdCounts[$categoryData->OrgID] !== 0 && $categoryData->Name != '') {
                                        $shouldShowOrgCat = true;
                                        break;
                                        }
                                        }
                                        if ($shouldShowOrgCat) {
                                        @endphp
                                        <tr class="table-name">
                                            <td colspan="10" value="">{{ $city_name }}</td>
                                        </tr>
                                        @php
                                        }
                                        }
                                        // Display the organization row
                                        @endphp
                                        <tr>
                                            <td value="">{{ $datas->Name }}</td>
                                            <td value="{{ $datas->OrgID }}">{{ $firstIdCounts[$datas->OrgID] }}</td>
                                            <td class="text-center">
                                                <form action="" class="mb-0">
                                                    <a href="{{ url('IIN/sublist-' . base64_encode($datas->OrgID)) }}" data-toggle="tooltip" title="Edit" class="btn btn-social-icon cst-edit"><i class="fa fa-pencil-square-o"></i> </a>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                        }
                                        }
                                        @endphp
                                    </tbody>
                                </table>
                                {{ $response->appends(request()->except('page'))->links() }}
                            </div>
                            <div class="table-responsive">
                            <table border="0" class="table" cellpadding="2" cellspacing="0">
                                <caption class="p-3">FlashAlert Subscriber Management<br>
                                </caption>
                                <tbody>
                                    <tr colspan="10">
                                        <td class="TableDivider">Purge FlashAlert Users</td>
                                        <td class="TableDivider"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input id="deleteButton" class="btn btn-danger" name="PurgeBlankAccounts" value="Delete FlashAlert Users who have no subscriptions">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            [ <b><a href="{{route('psub_subCR')}}">Subscriber Count Report</a></b> ] [ <b><a href="{{route('p_unsublist')}}">FlashAlert Unsubs</a></b> ]<br><br>
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
    $(document).ready(function() {
        // Attach a click event to the button
        $('#deleteButton').on('click', function() {
            alert('hi');
            // Confirm the deletion
                // Send an AJAX request to the server
                let url = "{{route('del.user')}}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { PurgeBlankAccounts: true },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
        });
    });

</script>
@endsection
