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
                <div class="box-header with-border cus-head">
                    <h3 class="box-title ">Subscribers:</h3>
                </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><b>{{ $catName[0]->Name }}</b></h4>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-block btn-warning"
                                    onclick="unsubscribe({{ $catName[0]->id }})">
                                    <i class="fa fa-fw fa-bell-slash mx-1" aria-hidden="true"></i>
                                    Unsubscribe All Subscribers
                                </button>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="box border-0">
                <div class="box-header with-border cus-head">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="box-title ">Email Address(es): </h3>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="{{ route('psub_list') }}" class="btn btn-info btn-xs ">Back</a>
                        </div>
                    </div>

                </div>

                <form role="form">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 subs-email">
                                @php
                                    $prevUserID = null;
                                    $emailString = '';
                                    $emailCount = count($emails); // Calculate the email count
                                @endphp
                                @foreach ($emails as $email)
                                    @if ($prevUserID !== $email->PublicUserID)
                                        @if (!is_null($prevUserID))
                                            <div>
                                                <a href=""> {{ rtrim($emailString, ', ') }} </a>
                                            </div>
                                        @endif
                                        @php
                                            $emailString = '';
                                            $prevUserID = $email->PublicUserID;
                                        @endphp
                                    @endif
                                    @php
                                        $emailString .= $email->UserEmailAddress . ', ';
                                    @endphp
                                @endforeach
                                @if (!is_null($prevUserID))
                                    <div>
                                        <a href=""> {{ rtrim($emailString, ', ') }} </a>
                                    </div>
                                @endif
                                @if (!is_null($prevUserID))
                                    {{ $emailCount }} email{{ $emailCount != 1 ? 's' : '' }}
                                @endif

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Pagination links -->
            <div class="row">
                <div class="col-md-12">
                    {{ $emails->links() }}
                </div>
            </div>
            <!-- Add the following code to display the success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </section>
    </div>
    <script>
        function unsubscribe(id) {
            var url = '<?php echo url('IIN/unsubscribe-all'); ?>' + '/' + id;
            swal({
                    title: `Are you sure you want to Unsubscribe all subscribers?`,
                    text: "If you Unsubscribe all subscribers, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        location.replace(url);
                    }
                });
        }
    </script>
@endsection
