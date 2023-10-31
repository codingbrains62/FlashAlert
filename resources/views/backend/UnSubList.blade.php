@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>FlashAlert Subscriber Management
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
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
                                        <th class="col-xs-10">FlashAlert Users with no Subscriptions:</th>
                                        <th class="col-xs-2"><a href="{{ route('psub_list') }}"
                                                class="btn btn-info btn-xs ">Back</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr value="">
                                            <td class="col-xs-12">{{ $email->EmailAddress }}</td>
                                            {{-- <td class="col-xs-12">Total Count: {{ $email->count }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $emails->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection