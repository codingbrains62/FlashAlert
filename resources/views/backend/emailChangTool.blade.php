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
                                    <form>
                                        <div class="form-group">
                                            <label for="oldEmail">Enter Old Domain: (i.e. solidtechnology.com)</label>
                                            <input type="text" class="form-control" placeholder="Enter Old Email/Domain" name="oldEmail" value=""">
                                        </div>
                                        <div class="form-group">
                                            <label for="newEmail">Enter New Domain:</label>
                                            <input type="text" class="form-control" placeholder="Enter New Email/Domain" name="newEmail" value=""/>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-warning col-xs-12 col-sm-4 col-md-3" type="submit" name="SubmitFind" value="Preview">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
