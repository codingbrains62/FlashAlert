@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-body">
                            <h4 class="bg-info p-3">FlashAlert Subscriber Accounts
                                <small></small>
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <form method="post" action="{{ route('processEmailChange') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="oldEmail">Enter Old Domain: (i.e. solidtechnology.com)</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Old Email/Domain" name="oldEmail"
                                                    value="{{ old('oldEmail') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="newEmail">Enter New Domain:</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter New Email/Domain" name="newEmail"
                                                    value="{{ old('newEmail') }}">
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-warning col-xs-12 col-sm-4 col-md-3" type="submit"
                                                    name="SubmitFind" value="Preview">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @if (isset($oldEmail) && isset($newEmail))
                                <div class="row">
                                    <div class="col-md-2">
                                        <p><strong>Old Email:</strong> {{ $oldEmail }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p><strong>New Email:</strong> {{ $newEmail }}</p>
                                    </div>
                                    {{-- <div class="col-md-2">
                                <p><strong>Processed:</strong> Ok</p>
                            </div> --}}
                                </div>
                                <form method="post" action="{{ route('updateEmail') }}">
                                    @csrf
                                    <input type="hidden" name="oldEmail" value="{{ $oldEmail }}">
                                    <input type="hidden" name="newEmail" value="{{ $newEmail }}">
                                    <button class="btn btn-success" type="submit">Processed</button>
                                </form>
                            @endif
                            
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
