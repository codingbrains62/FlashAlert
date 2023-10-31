<style>
    .button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #searchContainer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Post News Releases (One-month archive visible to media)
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">News Releases (one month archive)</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class=" ">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <form method="post" action="{{ route('fa.postnewsrelease') }}">
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
                                                        <option value="0">All Regions</option>
                                                        @foreach ($data as $datas)
                                                            <option value="{{ $datas->id }}"
                                                                @if ($datas->id == $selectedRegion) selected @endif>
                                                                {{ $datas->Description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="col-md-4">
                                                    <!-- Your existing HTML code for the checkbox -->
                                                    <div class="form-group">
                                                        <label>
                                                            <input type="checkbox" name="olderThan60" value="1"
                                                                @if ($checkboxState) checked @endif
                                                                onchange="this.form.submit()">
                                                            <b>After 60 days</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($category != '')
                                                <div class="col-md-12">
                                                    <div id="orgCatDropdown">
                                                        <div class="col-md-4">
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
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- @if (Route::currentRouteName() !== 'fa.postnewsrelease') --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-6 mb-999">
                                                    <label for="searchHeadline">Search Headline:</label>
                                                    <input type="text" name="searchHeadline" class="form-control"
                                                        value="{{ $searchHeadline }}" placeholder="Enter headline...">
                                                    </div>
                                                    <!-- Use type="submit" for the search button -->
                                                    <div class="col-md-6 mt-25">
                                                    <button type="submit" class="btn btn-primary">Find</button>
                                                    <button type="submit" name="allButton" value="1"
                                                        class="btn btn-primary" onclick="resetInput()">All</button>
                                                </div>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                        </div>
                                        {{-- @if (Route::currentRouteName() !== 'fa.newsReleaseArchives') --}}
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <a href="{{route('fa.fa-news-release')}}" class="btn btn-primary">Add a News Release</a>
                                            </div>
                                        </div>
                                        {{-- @endif --}}
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
                                                <th>Name/Headline or OrgID</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $current_state = null;
                                            $current_orgCat = null;
                                            $current_org = null;
                                            foreach ($response as $datas) {
                                            $state_name = $datas->Description;
                                            $city_name = $datas->CatagoryName;
                                            $org_name = $datas->Name;
                                            if ($state_name != $current_state) {
                                            $current_state = $state_name;
                                            ?>
                                            <tr class="table-name reason-bg1" style="background-color:#263102; color:#fff;">
                                                <td colspan="10" value="">{{ @$state_name }}</td>
                                            </tr>
                                            <?php
                                            }
                                            if ($city_name != $current_orgCat) {
                                            $current_orgCat = $city_name;
                                            ?>
                                            <tr class="table-name reason-bg2">
                                                <td colspan="10" value="trtr">{{ @$city_name }}</td>
                                            </tr>
                                            <?php
                                                }
                                               if ($org_name != $current_org) {
                                                $current_org = $org_name;
                                                ?>
                                            <tr class="table-name reason-bg3">
                                                <td colspan="10" value="trtr">{{ @$org_name }}</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    }
                                                   ?>
                                                <td value="">{{ @$datas->Headline }}</td>
                                                <td value="">
                                                    {{ date('d/m/y g:i A', strtotime(@$datas->EffectiveDate)) }}</td>
                                                <td class="text-nowrap">
                                                    <form action="">
                                                        <a href="" class="button">Edit</a>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
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

        function resetInput() {
            // Find the input field by its name attribute and set its value to an empty string
            document.querySelector('input[name="searchHeadline"]').value = '';
            // Find the checkbox by its name attribute and uncheck it
            document.querySelector('input[name="olderThan60"]').checked = false;

            // Reset the region dropdown to "All Regions" option (value="0")
            document.getElementById('regionDropdown').value = 0;

            // Call the function to update the organization category dropdown
            updateOrgCatSelect();
        }
    </script>
@endsection
