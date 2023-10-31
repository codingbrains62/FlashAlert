@extends('backend.layouts.backapp')
@section('title', 'Quick Signup')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quick Signup
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Quick Signup</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <form method="post" action="{{ route('get.quicksignup') }}">
                    @csrf
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="info-box box-body">
                            <h4 class="bg-info p-3" >Quick Signup</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label> Region </label>
                                    <div>
                                        <select class="form-control" id="getquicksignup" name="Region">
                                            <option value="">Select</option>
                                            @foreach ($data as $datas)
                                                <option value="{{ $datas->id }}">{{ $datas->Description }}</option>
                                            @endforeach
                                        </select>
                                        @error('Region')
                                            <span style="color:red;" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            
                            {{-- Organization Category Container --}}
                            <div id="orgCatContainer" style="display: none;">
                                
                                {{-- End Organization Category Container --}}
                                <div id="hide">
                                    <h4 class="bg-info p-3">New Organization </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Organization Category:</label>
                                                    <select class="form-control" id="orgCategory" name="category">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span id="orgcat-error" style="color: red;"></span>
                                            </div>

                                        @foreach (['orgname' => 'Organization Name', 'uname' => 'Username', 'password' => 'Password'] as $field => $label)
                                        <label ><b>{{ $label }} <span class="text-danger">*</span></b> </label>
                                        <p>
                                            @if ($field === 'orgname')
                                                This is the official name that will appear in the reports. It should be as
                                                short
                                                as possible and may be edited for consistency in style with similar
                                                organizations.
                                            @elseif($field === 'uname')
                                                This is the shorthand name you will use to identify yourself to the system.
                                                It
                                                can be an abbreviation.
                                            @else
                                                Choose a password of 4-64 letters and/or numbers. It is not case sensitive.
                                            @endif
                                        </p>
                                        <div  class="form-group">
                                            <input class="form-control" type="{{ $field === 'password' ? 'password' : 'text' }}"
                                                name="{{ $field }}" size="60">
                                            <span id="{{ $field }}-error" style="color: red;"></span>
                                        </div>
                                    @endforeach
                                    <div class="form-group col-sm-4 p-0 col-xs-12">
                                        <input type="submit" value="ADD" class="btn btn-block btn-primary ">
                                    </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            // Event listener for region dropdown change
            $('#getquicksignup').on('change', function() {
                var selectedRegion = $(this).val();

                if (selectedRegion) {
                    // Show the organization category container
                    $('#orgCatContainer').show();

                    // Make an AJAX request to fetch organization categories for the selected region
                    $.ajax({
                        url: '{{ route('quick.orgcat') }}', // Use the named route for the AJAX URL
                        method: 'POST',
                        data: {
                            regionId: selectedRegion
                        },
                        success: function(response) {
                            // Clear the previous options
                            $('#orgCategory').empty();

                            // Append the "Select" option as the default
                            $('#orgCategory').append($('<option>', {
                                value: '',
                                text: 'Select'
                            }));

                            // Append new options based on the response
                            $.each(response, function(key, value) {
                                $('#orgCategory').append($('<option>', {
                                    value: key,
                                    text: value
                                }));
                            });
                        },
                        error: function() {
                            console.log(
                                'Error occurred while fetching organization categories.');
                        }
                    });
                } else {
                    // Hide the organization category container if no region is selected
                    $('#orgCatContainer').hide();
                }
            });
        });
    </script>

    <script>
        $(document).on('click', 'input[type="submit"]', function(event) {
            event.preventDefault();

            var selectedOrgCat = $('#orgCategory').val();

            if (!selectedOrgCat) {
                // Show the error message
                $('#orgcat-error').text('Please select an organization category.');

                // Remove the error message after a delay (e.g., 3 seconds)
                setTimeout(function() {
                    $('#orgcat-error').text('');
                }, 3000);
                return; // Stop form submission if organization category is not selected
            }

            // Clear the error message if organization category is selected
            $('#orgcat-error').text('');

            var fields = ['orgname', 'uname', 'password'];
            var errors = {
                orgname: 'Organization name is required.',
                uname: 'Username is required.',
                password: 'Password is required.'
            };
            fields.forEach(function(field) {
                var value = $('input[name="' + field + '"]').val();
                if (!value) {
                    $('#' + field + '-error').text(errors[field]);
                } else {
                    $('#' + field + '-error').text('');
                }
            });
            if (fields.every(function(field) {
                    return $('input[name="' + field + '"]').val()
                })) {
                $('form').submit();
            }
        });
        // Add event listeners to clear error messages on field focus
    $('input[type="text"]').on('focus', function() {
        var fieldName = $(this).attr('name');
        $('#' + fieldName + '-error').text('');
    });

    $('input[type="password"]').on('focus', function() {
        var fieldName = $(this).attr('name');
        $('#' + fieldName + '-error').text('');
    });
    </script>
@endsection