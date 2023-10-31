@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>FlashAlert Subscriber Management
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Public Subscriber</li>
            </ol>
        </section>
        <section class="content">
            <div class="box border-0">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 subs-email">
                            <table class="table table-hover">
                                <thead class="thead-bg">
                                    <tr>
                                        <th class="col-xs-6">Org Name:</th>
                                        <th class="col-xs-6">Subscribers Count</th>
                                        <th class="col-xs-2"><a href="{{ route('psub_list') }}"
                                                class="btn btn-info btn-xs ">Back</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orgSubscription as $orgSub)
                                        <tr value="{{ $orgSub->OrgID }}">
                                            <td class="col-xs-6">{{ $orgSub->Name }}</td>
                                            <td class="col-xs-6">{{ $orgSub->count }}</td>
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
@endsection
