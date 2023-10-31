@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <style>
        .drag-wrap {
            width: auto;
            margin: auto;
            border-radius: 4px;
            background-color: #10203a;
            box-shadow: 0 1px 2px 0 #c9ced1;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .drag-file {
            position: relative;
            max-width: 100%;
            font-size: 16px;
            font-weight: 600;
        }

        .file__input,
        .file__value {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            margin-bottom: 0.875rem;
            color: rgba(255, 255, 255, 0.3);
            padding: 10px;
        }

        .file__input--file {
            position: absolute;
            opacity: 0;
            height: 80px;
            width: 74%;
        }

        .file__input--label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0;
            cursor: pointer;
        }

        .file__input--label:after {
            content: "Choose Files";
            border-radius: 3px;
            background-color: #2e4261;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.18);
            padding: 0.9375rem 1.0625rem;
            color: white;
            cursor: pointer;
            margin: 8px 0px;
        }

        .file__value {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(255, 255, 255, 0.6);
            border: 1px solid #5b5b7a;
            padding: 4px;
            margin: 6px 3px;
            font-size: 12px;
        }

        .file__value:hover:after {
            color: white;
        }

        .file__value:after {
            content: "X";
            cursor: pointer;
            margin: 0 0 0 8px;
            font-size: 13px;
            color: #fff;
            padding: 0px;
            width: 16px;
            border-radius: 50px;
            background: #951a1a;
            height: 17px;
            text-align: center;
        }

        .file__value:after:hover {
            color: white;
        }

        .file__remove {
            display: block;
            width: 20px;
            height: 20px;
            border: 1px solid #000;
        }

        button.drag-upload {
            border: none;
            border-radius: 1px;
            padding: 7px 18px;
            color: #fff;
            background: #28a745;
            font-weight: bold;
            margin: 6px 0 0px;
            transition: all 0.5s ease;
        }

        button.drag-upload:hover {
            color: #28a745;
            background: #fff;
        }

        .file__value--text {
            color: #dfdfdf;
            text-transform: capitalize;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Add a News Releases
                <small></small>
            </h1>
            <ol class="breadcrumb fw-6 font-14">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Add a News Releases</li>
            </ol>
        </section>
        <section class="content">
            <form method="post" action="{{ route('fa.fa-news-release') }}">
                @csrf
                <div class="box border-0">
                    <div class="box-header with-border cus-head">
                        <h3 class="box-title">News Release</h3>
                    </div>
                    <div class="box-body">
                        <p><b>Organization</b> (The system will include your organization's name and the date at the top of
                            the release.)</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="" name="region"
                                        onchange="this.form.submit();">
                                        <option value="">Select</option>
                                        @foreach ($region as $regions)
                                            <option value="{{ $regions->id }}"
                                                @if ($regions->id == $selectedregion) selected @endif>
                                                {{ $regions->Description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (!empty($orgcat))
                                <div id="" class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" id="" name="orgcat"
                                            onchange="this.form.submit();">
                                            <option value="">Select</option>
                                            @foreach ($orgcat as $orgcats)
                                                <option value="{{ $orgcats->id }}"
                                                    @if ($orgcats->id == $selectedorgcat) selected @endif>
                                                    {{ $orgcats->CatagoryName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($org) && !empty($orgcat))
                                <div id="" class="col-md-3">
                                    <div class="form-group">
                                        <select name="org" id="orgSelect" class="form-control"
                                            onchange="showAndSubmit();">
                                            <option value="">Select</option>
                                            @foreach ($org as $orgs)
                                                <option value="{{ $orgs->id }}"
                                                    @if ($orgs->id == old('org', $selectedorg)) selected @endif>
                                                    {{ $orgs->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="showdata" style="display:none;">
                    <div class="box-body">
                        <div class="row mb-2">
                            <div>
                                <div class="col-md-12 mt-3">
                                    <p><b>Headline</b> (Upper and lower case, system will put headline in caps when sent)
                                    </p>
                                    <input type="text" class="form-control" id="headline" autocomplete="off">
                                </div>
                                <div class="col-md-12 my-3">
                                    <label for=""><b>Text/Body</b></label>
                                    <textarea id="post_text" class="post-area form-control"></textarea>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <p><b>Contact info for news media only</b> (include phone/cell number and email address)
                                    </p>
                                    <textarea class="form-control mb-3" rows="3" id="contact_info" autocomplete="off"></textarea>
                                </div>

                                <div class="col-sm-12 col-md-6 my-2">
                                    <div class="btn-group" id="emailDropdownContainer">
                                        <button type="button" class="btn btn-primary dropdown-toggle fw-6"
                                            data-toggle="dropdown" aria-expanded="true" onclick="validateForm()">
                                            Email me a preview of release (to this point)
                                            <span class="caret"></span>
                                        </button>
                                        <p id="msg"></p>
                                        <ul class="dropdown-menu" role="menu" id="emailDropdown">
                                            @if (isset($notifyData[0]) && $notifyData[0] != '')
                                                <li><a tabindex="-1" href="javascript:void(0)"
                                                        onclick="selectEmail('{{ $notifyData[0]->PrimaryWorkEmail }}')">
                                                        <strong>{{ $notifyData[0]->PrimaryWorkEmail }}</strong>
                                                    </a>
                                                </li>
                                                <li><a tabindex="-1" href="javascript:void(0)"
                                                        onclick="selectEmail('{{ $notifyData[0]->SecondaryWorkEmail }}')">
                                                        {{ $notifyData[0]->SecondaryWorkEmail }}
                                                    </a></li>
                                                {{-- <li role="presentation"><a tabindex="-1" href="#">Something else</a></li> --}}
                                                <li><a tabindex="-1" href="#" data-toggle="modal"
                                                        data-target="#modal-default">Send to another Address</a></li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 text-end my-2">
                                    <button class="btn btn-success fw-6"  ><a href="mailto:voice@flashalert.net" onclick="location.href='voice@flashalert.net'" style="color: #fff;">Convert release
                                        to voice? (Additional $10 charge per release)</a></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Send text preview to</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" id="modalEmailInput"
                                                placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                            onclick="selectEmail(document.getElementById('modalEmailInput').value)">Send
                                            Mail</button>
                                        <button type="button" class="btn btn-default pull-right"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- ------------  Picture & attachements ,Delivery Options  ---------------- --}}
                        <div class="box border-0">
                            <div class="box-header with-border cus-head">
                                <h3 class="box-title ">Pictures & Attachments</h3>
                            </div>
                            <div class="row box-body">
                                <div class="col-md-12">
                                    <b>Attachments </b><small> (Optional)</small>
                                    <p>Select a photo, PDF or other file for distribution to the media. Due to their large
                                        bandwidth requirements, please host videos on your server or YouTube and include the
                                        link to it in the text field above. Please ensure that you have permission to use
                                        the image.</p>
                                    <div class="form-group">
                                        <p class="mb-0"><b>List of Files to be Uploaded</b> (Max 15; remember to use
                                            conventional file names, i.e. only letters and numbers)</p>
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="exampleInputFile" />
                                        <p class="help-block">
                                            Attach an additional file
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box border-0">
                            <div class="box-header with-border cus-head">
                                <h3 class="box-title ">Delivery Options</h3>
                            </div>
                            <div class="row box-body">
                                <div class="col-md-12">
                                    <b>Deliver my news release to the news media in these cities</b>
                                    <div class="grey-inside my-3">
                                        <p class="mb-0">Cities in red<b class="txt-red"> have TV/radio stations</b>
                                            cities in black are newspaper-only.</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box-group" id="accordion">
                                                @foreach ($regionWithCities as $region)
                                                    <?php $selectedCount = 0; ?>
                                                    <div class="panel box box-primary accord-box">
                                                        <div class="box-header with-border p-0">
                                                            <h4 class="box-title d-flex space-between"
                                                                style="display: flex">
                                                                <a data-toggle="collapse" data-parent="#accordion"
                                                                    href="#collapse-{{ $region->RegionID }}">
                                                                    {{ $region->Description }}
                                                                    <?php
                                                            foreach ($region->cities as $city) {
                                                                if ($city->isDefault) {
                                                                    $selectedCount++;
                                                                }
                                                            }
                                                            if ($selectedCount != 0 || $selectedCount != null) {
                                                            ?>
                                                                    <span
                                                                        class="pull-right">(<strong>{{ $selectedCount }}</strong>
                                                                        selected)</span>
                                                                    <?php } ?>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse-{{ $region->RegionID }}"
                                                            class="panel-collapse collapse">
                                                            <div class="box-body">
                                                                @if ($region->cities)
                                                                    @foreach ($region->cities as $city)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                    {!! $city->isDefault ? 'checked' : '' !!}>
                                                                                {!! $city->CityName !!}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <strong>Also Notify:</strong>
                            @if (isset($notifyData[0]) && $notifyData[0] != '')
                                <?php
                                $suborg = Helper::getSubOrg($notifyData[0]->OrgID);
                                // echo '<pre>';
                                // print_r($suborg);
                                // die();
                                ?>
                                @if ($childOrganizations->isNotEmpty() || $orgCatWithOrg->ParentOrgID != null)
                                    <table class="SmallTable">
                                        <tbody>
                                            <tr>
                                                <th>Organization</th>
                                                <th>Business Partners</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $orgCatWithOrg->Name }}</td>
                                                <td> - </td>
                                            </tr>
                                            @foreach ($suborg as $suborgs)
                                                <tr>
                                                    <td style="padding-right:10px;padding-left:15px;">
                                                        <span style="color:#CCC;">└ </span>{{ @$suborgs->Name }}
                                                    </td>
                                                    <td> - </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    {{-- Display checkboxes and labels when $suborg is empty --}}
                                    @if ($notifyData[0]->DefaultMailBusinessPartners == 1)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                    {{ $notifyData[0]->DefaultMailBusinessPartners == 1 ? 'checked' : '' }}>
                                                Business Partners <span class="">({{ $countBusspartner }})</span>
                                            </label>
                                        </div>
                                    @endif

                                    @if (!empty($busspartnergroup))
                                        <div class="sub-business-partners">
                                            <?php
                                            // Count occurrences of each group
                                            $groupCounts = [];
                                            foreach ($busspartnergroup as $group) {
                                                $groupName = $group->GroupName;
                                                $groupId = $group->id;
                                                if (!isset($groupCounts[$groupName])) {
                                                    $groupCounts[$groupName] = 1;
                                                } else {
                                                    $groupCounts[$groupName]++;
                                                }
                                            }
                                            ?>
                                            @foreach ($groupCounts as $groupName => $count)
                                                <div class="">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                                        style="color:#CCC;">└ </span>&nbsp;
                                                    <input type="checkbox"
                                                        name="{{ $groupName }}{{ $groupId }}">
                                                    &nbsp;{{ $groupName }} <span style="color:#666;">
                                                        ({{ $count }})
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if ($notifyData[0]->FlashAlertSubscriber == 1)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                    {{ $notifyData[0]->FlashAlertSubscriber == 1 ? 'checked' : '' }}>
                                                FlashAlert Messenger subscribers <span
                                                    class="">({{ $countfaMS }})</span>
                                            </label>
                                        </div>
                                    @endif

                                    @if ($notifyData[0]->DefaultNotifyTwitter == 1 || $notifyData[0]->TwitterUser != null)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                    {{ $notifyData[0]->DefaultNotifyTwitter == 1 ? 'checked' : '' }}>
                                                Twitter
                                            </label>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4 mt-5">
                            <div class="grey-inside">
                                <p class="mb-0">Cities in red<b class="txt-red"> have TV/radio stations</b>
                                    cities in black are newspaper-only.</p>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="col-sm-6  col-md-4 col-lg-3">
                                <button type="button" class="btn btn-block btn-success">Send News Release
                                    Now</button>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 margin-sm-y">
                                <button type="button" class="btn btn-block btn-primary">Save as Draft or Send
                                    Later</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script>
        CKEDITOR.replace("post_text", {
            language: "en",
            uiColor: "#dddddd",
            height: 100,
            resize_dir: 'vertical'
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const orgDropdown = document.getElementById('orgSelect');
            const showdata = document.getElementById('showdata');

            if (orgDropdown.value !== "") {
                showdata.style.display = 'block';
            }
        });

        function showAndSubmit() {
            const orgDropdown = document.getElementById('orgSelect');
            const showdata = document.getElementById('showdata');

            if (orgDropdown.value === "") {
                showdata.style.display = 'none';
            } else {
                showdata.style.display = 'block';
                orgDropdown.form.submit();
            }
        }
    </script>

    <script>
        document.addEventListener('click', function(event) {
            var emailDropdownContainer = document.getElementById('emailDropdownContainer');
            var emailDropdown = document.getElementById('emailDropdown');
            if (emailDropdownContainer.contains(event.target)) {
                // Click occurred inside the dropdown container; do nothing.
            } else {
                // Click occurred outside the dropdown container; close the dropdown.
                emailDropdown.style.display = 'none';
            }
        });

        function selectEmail(email) {
            $("#msg").text("Sending....");
            var emailDropdown = document.getElementById("emailDropdown");
            emailDropdown.style.display = "none";
            var email = email;
            // alert(email);
            var headline = document.getElementById("headline").value;
            var postText = CKEDITOR.instances.post_text.getData();
            var contactInfo = document.getElementById("contact_info").value;
            let orgDropdown = document.getElementById('orgSelect');
            var selectedOrgDropdownValue = orgDropdown.value;
            //alert(contactInfo);

            if (email !== null) {
                $("#msg").text("Sending....");
            } else {
                // Prompt the user to enter an email address
                var modalEmailInput = document.getElementById("modalEmailInput").value;
                    if (modalEmailInput === "") {
                        alert("Please enter an email address in the modal.");
                        return;
                    }
                email = modalEmailInput;
                $("#modal-default").modal("hide");
            }
            $.ajax({
                type: 'post',
                // url: '{{ route('detailsform') }}',
                url: "{{ url('IIN/postnewsrel') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                    headline: headline,
                    post_text: postText,
                    contact_info: contactInfo,
                    orgDropdown: selectedOrgDropdownValue
                },
                success: function(response) {
                    // Handle the response from your controller, if needed
                    console.log(response);
                    $("#msg").text(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors, if any
                    console.error(xhr.responseText);
                }
            });
        }

        function validateForm() {
            var headline = document.getElementById("headline").value;
            // var postText = document.getElementById("post_text").value;
            var postText = CKEDITOR.instances.post_text.getData();
            var contactInfo = document.getElementById("contact_info").value;
            var emailDropdown = document.getElementById("emailDropdown");
            emailDropdown.style.display = "none";
            if (headline == "" || postText.trim() === "" || contactInfo == "") {
                alert("Please enter a headline, body or contact info first.");
                emailDropdown.style.display = "none"; // Hide the dropdown menu
            } else {
                // Form is valid, you can proceed with sending the email or other actions.
                // Add your code here to send the email or perform the desired action.
                emailDropdown.style.display = "block"; // Show the dropdown menu
            }
        }
    </script>
@endsection
