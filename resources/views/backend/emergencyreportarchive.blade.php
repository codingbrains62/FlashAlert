@extends('backend.layouts.backapp')
@section('title', 'Emergency Report')
@section('content')
<style>
    .horizontal-line {
    border-top: 1px solid #ccc; /* You can adjust the color and thickness as needed */
    margin: 10px 0; /* Optional: Add some margin above and below the line */
}
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Emergency Report Archive
         <small></small>
      </h1>
      <ol class="breadcrumb fw-6 font-14">
         <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Emergency Report Archive</li>
      </ol>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <p> Please note that this beta version shows the start and end times of original messages.
               For now, this accounting will not show updates to the original message.
            </p>
         </div>
         <div class="col-md-12 col-sm-12 col-xs-12">
          @foreach($user as $users)
            <div class="box">
               <div class="box-body table-responsive no-padding tbl-border mt-4">
                    
                     <div class="col-xs-12 col-sm-3 col-md-3 mb-sm8">
                        <h4 style="color:#656565;margin:0;padding:0px;">
                           <span style="font-weight:normal;">For </span>{{ \Carbon\Carbon::parse($users->EffectiveDate)->isoFormat('MMM Do') }}
                        </h4>
                        <span style="font-size:0.9em;color:#999;" title="Time of first post and last update (if applicable)">
                        Created: {{ \Carbon\Carbon::parse($users->EffectiveDate)->isoFormat('MMM Do') }} <br>{{ \Carbon\Carbon::parse($users->EffectiveDate)->format('g:i A') }}</span>
                     </div>
                     <div class="col-xs-12 col-sm-3 col-md-9">{{$users->Note}}<br>
                        <span style="font-size:0.9em;color:#999;">Report: #{{$users->id}}<br>EXPIRED - {{$users->ExpirationDate}}<br>Posted from: {{$users->IPAddress}}<br>
                        @if($users->SendToTwitter!='')
                        Sent to Twitter
                        <br>
                        @endif
                        
                        @if($users->DeliverSubNumAddress!='')
                        Sent to {{$users->DeliverSubNumAddress}} subscribers.
                        @endif
                        </span>
                     </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
</div>
</section>
</div>
@endsection