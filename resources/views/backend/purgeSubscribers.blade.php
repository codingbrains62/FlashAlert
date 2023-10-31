<style>
    h4.box-title {
        font-weight: bold;
        color: white;
        background: #495A6D;
        padding: 5px 10px;
    }
</style>
@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <h4 class="box-title m-0 p-3">FlashAlert Subscriber Accounts
                                        <small></small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <form role="form" class="mb-0" method="post" action="{{ route('purg_subs') }}">
                            @csrf
                            <div class="box-footer form-group mb-0">
                                <label class="col-sm-4 col-md-2 control-label">Find accounts not logged in since</label>
                                <div class="col-sm-4 col-md-3">
                                    <input class="form-control" type="date" name="SearchDate" value="<?php echo date('Y-m-d'); ?>" id="SearchDate">&nbsp;
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-12">
                                    <input type="submit" class="btn btn-block btn-success" id='searchForm' name="find_flashalerts" value="Submit">
                                </div>
                            </div>
                        </form>
                        @if (isset($publicUsers21) && !empty($publicUsers21))
                        <div class="table-responsive" id="results">
                            <h4 class="box-title p-3">Message Recipients<small></small></h4>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="thead-bg">
                                    <tr>
                                        <th>Email Address</th>
                                        <th>Org Name</th>
                                        <th>LastLogin date</th>
                                        <th>Validated</th>
                                        <th>Validated Code</th>
                                        <th>tet</th>
                                    </tr>
                                </thead>
                                <tbody class="v-align-mid ">
                                    @foreach ($publicUsers21 as $notLogData)
                                    <tr>
                                        <td>{{ $notLogData->EmailAddress }}</td>
                                        <td>{{ $notLogData->OrgName }}</td>
                                        <td>{{ $notLogData->LastLogin }}</td>
                                        <td>{{ $notLogData->Validated }}</td>
                                        <td>{{ $notLogData->ValidateCode }}</td>
                                        <td>Not Clear</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <h1 class="total-txt"><strong>&nbsp;Total Accounts: {{ $count1 }}, Total Email Addresses:
                                    {{ $emailCount }}</strong></h1>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="box border-0">
            <div class="box-body">
                <div class="col-md-12 p-0">
                    <h4 class="box-title p-3">FlashAlert Subscriber Accounts
                        <small></small>
                    </h4>
                    <button type="button" class="btn btn-primary mb-3" id="showUnvalidatedBtn">Show unvalidated email
                        addresses</button>
                    <!-- </div> -->
                    @if (isset($uniqueRows) && !empty($uniqueRows))
                    <div class="table-responsive subs-email" id="unvalidatedEmailsDiv" style="display: none;">
                        <table class="table table-hover">
                            <thead class="thead-bg">
                                <tr>
                                    <th>Primary Email Address</th>
                                    <th>ValidPrimary</th>
                                    <th>Invalid Emails</th>
                                    <th>Org List</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($uniqueRows as $row)
                                <tr>
                                    <td>
                                        @if ($row->IsPrimary == 1)
                                        {{ $row->UserEmailAddress }}
                                        @else
                                        {{ $row->UserEmailAddress }}
                                        @endif
                                    </td>
                                    <td>{{ $row->Validated }}</td>
                                    <td>
                                        @if ($row->IsPrimary == 0 && $row->Validated == 0)
                                        {{ $row->UserEmailAddress }}
                                        @else
                                        {{ $row->UserEmailAddress }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $row->orgs->first()->name }}
                                        @if ($row->orgs->count() > 1)
                                        and {{ $row->orgs->count() - 1 }} other
                                        organization{{ $row->orgs->count() - 1 > 1 ? 's' : '' }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        No unvalidated email addresses found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (isset($count) && !empty($count))
                        <h4><b>Number of Accounts with at least one unvalidated address: {{ $count }}</b>
                        </h4>
                        @endif
                        {{-- <button type="submit" name="PurgeUnvalidated" class="btn btn-primary">Purge All Unvalidated
                                Emails</button>
                            <button type="submit" name="PurgeInvalidPrimaryEmail" class="btn btn-primary">Purge All
                                Accounts
                                with Invalid Primary Email Addresses</button> --}}
                        <button type="submit" form="purgeUnvalidatedForm" class="btn btn-danger" {{ $uniqueRows->isEmpty() ? 'disabled' : '' }}><i class="fa fa-trash mr-2"></i> Purge All Unvalidated
                            Emails</button>
                        <button type="submit" form="purgeInvalidPrimaryEmailsForm" class="btn btn-danger" {{ $uniqueRows->isEmpty() ? 'disabled' : '' }}><i class="fa fa-trash mr-2"></i> Purge All
                            Accounts with Invalid Primary Email Addresses</button>

                        <form id="purgeUnvalidatedForm" action="{{ route('purge.unvalidated') }}" method="post">
                            @csrf
                        </form>

                        <form id="purgeInvalidPrimaryEmailsForm" action="{{ route('purge.invalidPrimaryEmails') }}" method="post">
                            @csrf
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#showUnvalidatedBtn').click(function() {
            $('#unvalidatedEmailsDiv').toggle();
            $('#results').hide();
        });
    });
</script>
<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'pageLength': 50,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
@endsection