@extends('backend.layouts.backapp')
@section('title','QReport option')
@section('content')
<style>
    .td-btn form{
    display: inline-block;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Manage Report Options
        </h1>
        <ol class="breadcrumb fw-bold font-14">
            <li>
                <a href="{{url('/IIN/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a>
            </li>
            <li class="active">QReport</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <form role="form" method="post" action="{{ route('form.add_QReport') }}">
                          @csrf
                          <div class="row">
                            @if (Session::has('success'))
                            <script>    
                                swal({
                                    title: "Done!",
                                    text: "{{ Session::get('success') }}",
                                    icon: "success",
                                    timer: 3000
                                });
                            </script>
                                @elseif (Session::has('failed'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {{ Session::get('failed') }}
                                </div>
                                @endif
                                <input type="hidden" class="hdn" name="hidden" value="">
                              <div class="col-md-1">
                                <div class="form-group">
                                    <label>Rank</label>
                                    <input type="text" class="form-control rank" name="Rank" value="" required>
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group">
                                    <label>Column</label>
                                    <select class="form-control" id="columnsel" name="QuickReportID" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quick-Report Option</label>
                                    <input type="text" class="form-control QReport" name="Note" value="" required/>
                                </div>
                              </div>
                              {{-- <div class="col-md-2">
                                <div class="form-group">
                                    <label>Delete Time</label>
                                    <input type="text" class="form-control DTime" name="DeleteTime" id="DeleteTime" value="" required/>
                                </div>
                            </div> --}}
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Delete Time</label>
                                    <input type="text" class="form-control DTime" name="DeleteTime" id="DeleteTime" pattern="^(0[1-9]|1[0-2]):00 (AM|PM)$" placeholder="e.g., 01:00 AM" required/>
                                </div>
                            </div>
                            <div id="error-message" style="color: red;"></div>
                            <!--  <div class="col-md-2">
                                <div class="form-group">
                                    <label>Operating Status</label>
                                    <input type="text" class="form-control OStatus" name="OStatus" value="" maxlength="3" required/>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                    <label>Transpo Status</label>
                                    <input type="text" class="form-control TStatus" name="TStatus" value="" maxlength="3" required/>
                                </div>
                              </div> -->
                            </div>
                            <div class="box-footer row">
                                <button type="submit" class="btn btn-info col-xs-5 qrupdate col-md-2"><i class="fa fa-fw fa-upload"></i> Update</button>
                                <a href="" class="btn btn-danger col-md-2 col-xs-5 mx-3" id="qrcancel" ><i class="fa fa-fw fa-close"></i> Cancel</a>
                                <button type="submit" class="btn btn-success col-xs-12 col-sm-3 col-md-2 qradd"><i class="fa fa-fw fa-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   <!--  </section>
    <section class="content"> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Quick-Report Option</th>
                                    <th scope="col">Delete Time</th>
                                   <!--  <th scope="col">Operating Status</th>
                                    <th scope="col">Transpo Status </th> -->
                                </tr>
                            </thead>
                            <tbody class="fw-6 v-align-mid">
                                @foreach ($QReportData as $key => $QROption)
                                @if ($key == 0 || $QROption->QuickReportID != $QReportData[$key - 1]->QuickReportID)
                                    <tr>
                                        <td colspan="8" class="bg-grey-lite fw-bold">Column {{$QROption->QuickReportID}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="td-btn text-nowrap">
                                       
                                        <input class="min-length-2 fw-6" readonly value="{{ $QROption->Rank}}"/> 
                                        <form action="{{ route('qroptions.increase-rank', $QROption->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" data-toggle="tooltip" title="Increase" class="btn-increment plus"><i class="fa fa-fw fa-plus"></i></button>
                                        </form>
                                        <form action="{{ route('qroptions.decrease-rank', $QROption->id) }}" method="POST">
                                          @csrf
                                          <button type="submit" data-toggle="tooltip" title="Decrease" class="btn-increment minus"><i class="fa fa-fw fa-minus"></i></button>
                                        </form>
                                      </td>
                                    <td>{{$QROption->Note}}</td>
                                    <td>{{$QROption->DeleteTime}}</td>
                                    {{-- <td>{{$QROption->OperatingStatus}}</td>
                                    <td>{{$QROption->TStatus}}</td> --}}
                                    <td class="d-flex">
                                        <a href="javascript:void(0);" onClick="editQR({{$QROption->id}})" class="btn btn-social-icon cst-edit" id="scrollToTopButton"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-social-icon cst-del" onClick="deleteQR({{$QROption->id}})"><i class="fa fa-trash"></i></a>
                                    </td>
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
<script>
function editQR(id) {
 let QROptionId = id;
 $(".qradd").css("display", "none");
 $(".qrupdate").css("display","inline");
 $("#qrcancel").css("display","inline");
$.ajax({
        url: "{{ url('IIN/edit-QReport') }}",
        type: 'GET',
        data: {
                        "_token": "{{ csrf_token() }}",
                        "QROptionId": QROptionId,
                        } ,
        success: function(data) {
            // Handle the response data
            console.log(data);
            $('.rank').val(data.Rank);
            $('.hdn').val(data.id);
            $('#columnsel option')[data.QuickReportID-1].selected = true;
            $('.QReport').val(data.Note);
            $('.DTime').val(data.DeleteTime);
            //$('.OStatus').val(data.OperatingStatus);
            //$('.TStatus').val(data.TStatus);
        },
        error: function(xhr, status, error) {
            // Handle the AJAX error
            console.log(xhr.responseText);
        }
    });
window.scrollTo({ top: 0, behavior: 'smooth' });
}

// function deleteQR(id) {
//     let QROptionId = id;
//     if (confirm("Are you sure you want to delete this Quick Report data?")) {
//         $.ajax({
//             url: "{{ url('IIN/delete-QR') }}",
//             type: 'GET',
//             data: {
//                 "_token": "{{ csrf_token() }}",
//                 "QROptionId": QROptionId,
//             },
//             success: function(data) {
//                 // Handle the response data
//                 console.log(data);
//                 location.reload();
//             },
//             error: function(xhr, status, error) {
//                 // Handle the AJAX error
//                 console.log(xhr.responseText);
//             }
//         });
//     }
// }

 function deleteQR(id) {
let QROptionId = id;
swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your file has been deleted!", {
      icon: "success",
    });

    $.ajax({
            url: "{{ url('IIN/delete-QR') }}",
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
                "QROptionId": QROptionId,
            },
            success: function(data) {
                // Handle the response data
                console.log(data);
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle the AJAX error
                console.log(xhr.responseText);
            }
        });



  } else {
    swal("Your file is safe!");
  }
});
 }
</script>
{{-- <script>
    document.querySelector("#DeleteTime").addEventListener("blur", function() {
        var input = this.value;
        var isValid = /^(0[1-9]|1[0-9]|2[0-4]):00$/.test(input); // Validate that input contains 1 or 2 digits
        document.querySelector("#error-message").textContent = "";
        if (!isValid) {
            document.querySelector("#error-message").textContent = "Invalid input. Please enter a valid hour.";
            this.focus();
        } else {
            document.querySelector("#error-message").textContent = "";
        }
    });
</script> --}}
<script>
var deleteTimeInput = document.querySelector("#DeleteTime");
var errorMessage = document.querySelector("#error-message");
var addButton = document.querySelector(".qradd");

deleteTimeInput.addEventListener("focus", function() {
    addButton.disabled = true; // Disable the "Add" button when the input gains focus
    errorMessage.textContent = "";
});

deleteTimeInput.addEventListener("blur", function() {
    var input = this.value;
    var isValid = /^(0[1-9]|1[0-2]):00 (AM|PM)$/.test(input); // Validate as "01:00 AM" to "12:00 PM"

    if (!isValid) {
        errorMessage.textContent = "Invalid input. Please enter a valid hour in the format 'hh:00 AM/PM' (01 to 12).";
        this.focus();
        addButton.disabled = true; // Disable the "Add" button when there's an error
    } else {
        errorMessage.textContent = "";
        addButton.disabled = false; // Enable the "Add" button when the input is valid
    }
});
</script>

@endsection