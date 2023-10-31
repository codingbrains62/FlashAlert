@extends('backend.layouts.backapp')

@section('title','Failed Login')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Failed Login   

        </h1>

        <ol class="breadcrumb fw-bold font-14">

            <li><a href="{{url('/IIN/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Failed Login</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-xs-12">

                <div class="box">
                    <div class="box-body">
                        <form action="{{route('delete.selected') }}" method="POST" id="deleteForm">
                                @csrf
                                <button type="submit" class="btn btn-danger mb-4" onclick="validateForm(event)">
                                  <i class="fa fa-trash mx-2"></i>
                                    Selected</button>
                        <div class="table-responsive">  
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="bg-grey-lite">
                                    <tr>
                                        <th><input type="checkbox" name="chkall" class="chkall" id="chkall"> Select All
                                        </th>
                                        <th>User Name</th>
                                        <th>Address</th>
                                        <th>Time</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $users)
                                    <tr>
                                        <td><input type="checkbox" name="selecteId[]" class="chk" id="chk" value="{{$users->id}}"></td>
                                        <td>{{$users->username}}</td>
                                        <td>{{$users->address}}</td>
                                        <td>{{$users->failed_at}}</td>
                                    <!--  <td > <a href="{{url('IIN/del-failed-login/'.base64_encode(@$users->id))}}" class="btn btn-danger btn-xs" onclick="showConfirmDialog(event)">Delete</a>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                        <div class="pagination-info">
                                      Page <span class="current-page">{{$user->currentPage()}}</span> - Showing <span class="first-item">{{$user->firstItem()}}</span> to <span class="last-item">{{$user->lastItem()}}</span> of <span class="total">{{$user->total()}}</span>
                                    </div>

                        <div class="d-flex">

                          {{$user->links()}}

                        </div>

                    </div>



                </div>

            </div>



        </div>









    </section>



</div>
<script>
$(document).ready(function() {
  // When the checkbox with class "chkall" is clicked
  $(".chkall").click(function() {
    // Get the value of the "checked" property of the "chkall" checkbox
    var isChecked = $(this).prop("checked");
    
    // Set the "checked" property of all checkboxes with class "chk" to the same value as "chkall"
    $(".chk").prop("checked", isChecked);
  });
  
  // When any of the checkboxes with class "chk" are clicked
  $(".chk").click(function() {
    // Check if all checkboxes with class "chk" are checked
    var allChecked = $(".chk").length === $(".chk:checked").length;
    
    // Set the "checked" property of the "chkall" checkbox to the same value as allChecked
    $(".chkall").prop("checked", allChecked);
  });
});


 // function validateForm(event) {
 //        const checkboxes = document.querySelectorAll('input.chk');
 //        let isChecked = false;

 //        checkboxes.forEach((checkbox) => {
 //            if (checkbox.checked) {
 //                isChecked = true;
                
 //            }
 //        });

 //        if (!isChecked) {
 //            event.preventDefault();
 //            swal({
 //                title: "Opps!",
 //                text: "Plz Select Atleast one Checkbox.",
 //                icon: "error",
 //                buttons: true,
 //                dangerMode: true,
 //        })
 //        }
 //    }



    // Use a specific ID for the button to target it
    //const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
   // deleteSelectedBtn.addEventListener('click', showConfirmDialog1);

    // function showConfirmDialog1(event) {
    //     event.preventDefault(); // Prevents the default behavior of the form submission

    //     swal({
    //         title: "Are you sure?",
    //         text: "This action cannot be undone.",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //     .then((willDelete) => {
    //         if (willDelete) {
    //             // Submit the form
    //             document.getElementById('deleteForm').submit();
    //         }
    //     });
    // }




   
</script>

<script>
    function validateForm(event) {
        event.preventDefault(); // Prevent the form from submitting automatically.

        const checkboxes = document.querySelectorAll('input.chk');
        let isChecked = false;

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            swal({
                title: "Oops!",
                text: "Please select at least one checkbox.",
                icon: "error",
                buttons: true,
                dangerMode: true,
            });
        } else {
            // Show the delete confirmation popup
            swal({
                title: "Are you sure?",
                text: "This action cannot be undone.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Submit the form
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    }
</script>







@endsection