@extends('backend.layouts.backapp')
@section('title', 'Flash Alert')
@section('content')
    <style>
        .grey-head {
            background: #c1c8cb;
            color: #504c4c;
            padding: 6px 10px;
            font-size: 6px;
        }

        .grey-head h3 {
            margin: 0px;
            font-size: 16px;
        }

        .grey-inside {
            padding: 6px 16px;
            background: whitesmoke;
        }

        .accord-box .box-title {
            background: #efefef;
            padding: 10px;
        }

        .accord-box .box-title:hover {
            background: aliceblue;
            outline: auto 1px #ccc;
            ;
        }

        .accord-box .box-title a {
            width: 85%;
        }

        .orgcatt {
            font-weight: bold;
            font-size: 1.3em;
            text-shadow: 0px 1px 1px #FFF;
        }

        a.orgcattxt {
            color: #000033 !important;
            text-decoration: none;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Closure/Emergency Report:
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/IIN/dashboard') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active">Closure/Emergency Report:</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- ------------  Closure/Emergency Report ---------------- --}}
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <h3 class="box-title">Closure/Emergency Report</h3>
                            <h5 class="pull-right">
                                <a href="" class="btn btn-info btn-xs"></a>
                            </h5>
                        </div>
                        <form role="form">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mb-0"><img src="https://cdn-icons-png.flaticon.com/128/497/497738.png"
                                                alt="warning" class="img-fluid"
                                                style="width: 25px;height: 25px;  margin: 5px;">To send an emergency message
                                        </h4>
                                        <p>Build a message from the "Quick Report" drop down menus (preferred) <span
                                                class="text-danger">AND/OR</span> type a custom message into the text field.
                                        </p>
                                        <ul>
                                            <li> Post emergency messages in English. Spanish stations translate them and
                                                multi-language translation is available on <a href=""> your org’s
                                                    FlashAlert page</a></li>
                                            <li> Please read <a href="{{ url('guide.html') }}">Guidelines for Posting News
                                                    on FlashAlert</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="grey-head d-flex space-between">
                                <a href="#" class="orgcattxt">
                                    <h3 class="orgcatt">FlashAlert</h3>
                                </a>
                                <h6>Category: Businesses</h6>
                            </div>

                            <div class="box-body">
                                <div class="checkbox mt-0">
                                    <label>
                                        <input type="checkbox" id="myCheckbox" onchange="updateValu()">
                                        <b>This is an Update.</b> Check if this is an update to a message posted earlier
                                        today.
                                    </label>
                                </div>
                                <div class="checkbox mt-0">
                                    <label>
                                        <input type="checkbox" id="myCheckbox2" onchange="updateValu2()">
                                        <?php
                                        $today = new DateTime();
                                        $nextDate = $today->modify('+1 day');
                                        $day = $nextDate->format('D');
                                        $formatted_date = $nextDate->format('M jS, Y');
                                        ?>
                                        <b>This is for <span class="txt-red">Tomorrow</span>. </b> Check to send message
                                        now, but mark it for <span id="dateInfo"><?php echo $day . ', ' . $formatted_date; ?></span> instead of
                                        today.
                                    </label>
                                </div>
                                <strong>1) Quick Report for <i class="txt-red">district-wide</i> weather emergencies
                                </strong>
                                <p>Build your message with any or all of these pull-down menus, plus the text field below.
                                </p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Opening Status</label>
                                            <select class="form-control" name="openingStatus" id="openingStatus"
                                                size="1">
                                                <option selected value="0">Select Opening Status...</option>
                                                <?php
                                                // Assuming $reportOptn is an array containing options for the "Opening Status" dropdown
                                                foreach ($reportOptn as $reportOpt) {
                                                    if ($reportOpt->QuickReportID == 1) {
                                                        // Replace the following line with appropriate PHP logic to generate the value
                                                        $optionValue = date('h:i a', strtotime($reportOpt->DeleteTime));
                                                        echo '<option value="' . $optionValue . '">' . $reportOpt->Note . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Preschool/Kindergarten Status</label>
                                            <select class="form-control" name="preschoolStatus" id="preschoolStatus"
                                                size="1">
                                                <option selected value="0">Select Preschool/Kindergarten Status...
                                                </option>
                                                @foreach ($reportOptn as $reportOpt)
                                                    @if ($reportOpt->QuickReportID == 2)
                                                        <option value="{{ $reportOpt->id }}">{{ $reportOpt->Note }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Transportation Status</label>
                                            <select class="form-control" name="transportationStatus"
                                                id="transportationStatus" size="1">
                                                <option selected value="0">Select Transportation Status...</option>
                                                @foreach ($reportOptn as $reportOpt)
                                                    @if ($reportOpt->QuickReportID == 3)
                                                        <option value="{{ $reportOpt->id }}">{{ $reportOpt->Note }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <strong>2) <span class="txt-red">AND/OR</span> type additional CONCISE information
                                    below.</strong>
                                <p>Please do NOT include info you already chose from the menus above, nor "Due to the
                                    inclement weather...".</p>
                                <textarea class="form-control mb-3" id="myTextarea" rows="3" name="Note"></textarea>

                                <strong>3) OPTIONAL: Additional info for Messenger subscribers and Web sites</strong>
                                <textarea class="form-control mb-3" id="myTextareaOpt" rows="3" name="dd"></textarea>
                                <div class="d-flex space-between">
                                    <p class="m-0">Preview: Normal text goes to all; Italic text is additional info for
                                        Messenger/Web</p>
                                    <p class="m-0">( 10 Charasters )</p>
                                </div>
                                <div class="callout callout-warning">
                                    <strong style="font-size: 16px;">FlashAlert:</strong>
                                    <span class="mx-2" id="selectedOptionText1"></span>
                                    <span id="selectedOptionText2"></span>
                                    <span id="selectedOptionText3"></span>
                                    <span id="outputcon"></span>
                                    <span id="outputcontentopt"></span>
                                    <span id="mySpan" class="mx-2 fw-bold" style="font-size:16px;"></span>
                                    <span id="mySpan2" style="color: #880000;"></span>
                                    <input type="hidden" name="mergeContent">
                                </div>
                                <strong>Contact Info for News Media</strong>
                                <small>Include phone number and email address; not visible to public.
                                    If the reason for your message is obvious (i.e. snow), no need to include your contact
                                    info.</small>
                                <textarea class="form-control mb-3" id="" rows="3"></textarea>
                                <button class="outline-btn pull-right">Spell Check</button>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="txt-red" for="">Deleted at</label>
                                            <select class="form-control" name="deletedAt" id="deletedAt" size="1">
                                                <?php
                                                // Set the timezone to India Standard Time
                                                //date_default_timezone_set('Asia/Kolkata');
                                                // Set the timezone to Pacific Time Zone
                                                date_default_timezone_set('America/Los_Angeles'); // Pacific Time Zone
                                                // Set the timezone to Mountain Time Zone
                                                date_default_timezone_set('America/Denver'); // Mountain Time Zone
                                                // Get the current time
                                                $current_time = new DateTime();
                                                // Create DateTime objects for today and tomorrow
                                                $today = new DateTime();
                                                $tomorrow = (new DateTime())->modify('+1 day');
                                                // Set the start time to 12:00 AM midnight
                                                $start_time = clone $today;
                                                $start_time->setTime(0, 0, 0);
                                                // Set the end time to 11:00 PM of the next day
                                                $end_time = clone $tomorrow;
                                                $end_time->setTime(23, 0, 0);
                                                // Initialize an empty string to store the options
                                                $options = '';
                                                // Define the time interval (1 hour in this example)
                                                $interval = new DateInterval('PT1H');
                                                // Generate the options from the current time until 11:00 PM of the current day
                                                while ($start_time <= $end_time) {
                                                    // Calculate the current time
                                                    $time = $start_time->format('h:i a');
                                                    // Calculate the current date and time in the desired format
                                                    $formatted_option = $start_time->format('D. M. j - ') . $time;
                                                    // Check if the start time is greater than or equal to the current time
                                                    if ($start_time >= $current_time) {
                                                        // Determine if the current option is selected
                                                        $selected = '';
                                                        if ($start_time->format('h:i') === $current_time->format('h:i')) {
                                                            $selected = 'selected';
                                                        }
                                                        // Append the option to the options string
                                                        $options .= '<option value="' . $start_time->format('h:i a') . '" ' . $selected . '>' . $formatted_option . '</option>';
                                                    }
                                                    // Increment the time by 1 hour
                                                    $start_time->add($interval);
                                                }
                                                echo $options;
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- ------------  Closure/Emergency Report ---------------- --}}
                    {{-- ------------  Select Affected Cities start ---------------- --}}
                    <div class="box border-0">
                        <div class="box-header with-border cus-head">
                            <h3 class="box-title ">Select Affected Cities</h3>
                        </div>
                        <form role="form">
                            <div class="box-body test ">
                                <strong>Deliver my emergency report to the news media in these cities:</strong>
                                <div class="grey-inside">
                                    <p class="mb-0">Select <b>ONLY</b> the cities that are directly affected.</p>
                                    <p class="mb-0">Cities in <b class="txt-red">red have TV/radio stations</b> cities
                                        in black are newspaper-only.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-group" id="accordion">
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
                                                                        <span class="pull-right"><strong></strong></span>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-{{ $region->RegionID }}"
                                                                class="panel-collapse collapse">
                                                                <div class="box-body">
                                                                    @foreach ($region->cities as $city)
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox">
                                                                                {!! $city->CityName !!}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
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
                            <div class="col-md-8">
                                <strong>Also Notify</strong>
                                <?php
                                $suborg = Helper::getSubOrg($notifyData[0]->OrgID);
                                // echo '<pre>';
                                // print_r($suborg);
                                // die();
                                ?>
                                <table class="SmallTable" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Organization</th>
                                            <th>Business Partners</th>
                                            <th>Messenger Public</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $orgCatWithOrg->Name }}</td>
                                            <td> - </td>
                                            <td> - </td>
                                            {{-- <td>
                                                @if ($notifyData[0]->DefaultMailBusinessPartners == 1)
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                {{ $notifyData[0]->DefaultMailBusinessPartners == 1 ? 'checked' : '' }}>
                                                            <span class=""></span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($notifyData[0]->FlashAlertSubscriber == 1)
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                {{ $notifyData[0]->FlashAlertSubscriber == 1 ? 'checked' : '' }}>
                                                                <span class=""></span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </td> --}}
                                        </tr>
                                        @foreach ($suborg as $suborgs)
                                            <tr>
                                                <td style="padding-right:10px;padding-left:15px;">
                                                    <span style="color:#CCC;">└ </span>{{ @$suborgs->Name }}
                                                </td>
                                                <td> - </td>
                                                <td> - </td>
                                                {{-- <td style="padding-right:10px;">
                                                    @if ($notifyData[0]->DefaultMailBusinessPartners == 1)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"
                                                                    {{ $notifyData[0]->DefaultMailBusinessPartners == 1 ? 'checked' : '' }}>
                                                                <span class="">{{ $countBusspartner }}</span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td> --}}
                                                {{-- <td style="padding-right:10px;">
                                                    @if ($notifyData[0]->FlashAlertSubscriber == 1)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"
                                                                    {{ $notifyData[0]->FlashAlertSubscriber == 1 ? 'checked' : '' }}>
                                                                    <span class="">{{ $countfaMS }} subscriber</span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <tr>
                                    <td>
                                        @if ($notifyData[0]->DefaultNotifyTwitter == 1 || $notifyData[0]->TwitterUser != null)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                        {{ $notifyData[0]->DefaultNotifyTwitter == 1 ? 'checked' : '' }}>
                                                    Twitter
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if ($notifyData[0]->DefaultNotifyFacebook == 1)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                        {{ $notifyData[0]->DefaultNotifyFacebook == 1 ? 'checked' : '' }}>
                                                    Facebook
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </div>
                            <div class="col-md-4">
                                <div class="grey-inside">
                                    <p class="mb-0">You can deselect all cities above to send your message only
                                        to Business Partners, Messenger subscribers, Twitter and/or Facebook.</p>
                                </div>
                            </div>
                            <div class="col-md-2 pull-right mt-4">
                                <button type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o mx-1"
                                        aria-hidden="true"></i> Send</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>
            {{-- ------------  Select Affected Cities end ---------------- --}}
    </div>
    </section>
    </div>
    <script>
        // JavaScript/jQuery code to handle the selection change event
        $('#openingStatus, #preschoolStatus, #transportationStatus').on('change', function() {
            var selectedOption1 = $('#openingStatus').val();
            var selectedOption2 = $('#preschoolStatus').val();
            var selectedOption3 = $('#transportationStatus').val();
            var selectedOptionText1 = '';
            var selectedOptionText2 = '';
            var selectedOptionText3 = '';

            if (selectedOption1 != 0 && selectedOption1 != null) {
                selectedOptionText1 = $('#openingStatus option:selected').text();
                $('#selectedOptionText1').text(selectedOptionText1).show();
            } else {
                $('#selectedOptionText1').hide();
            }


            if (selectedOption2 != 0 && selectedOption2 != null) {
                selectedOptionText2 = $('#preschoolStatus option:selected').text();
                $('#selectedOptionText2').text(selectedOptionText2).show();
            } else {
                $('#selectedOptionText2').hide();
            }

            if (selectedOption3 != 0 && selectedOption3 != null) {
                selectedOptionText3 = $('#transportationStatus option:selected').text();
                $('#selectedOptionText3').text(selectedOptionText3).show();
            } else {
                $('#selectedOptionText3').hide();
            }
        });

        function updateValu() {
            var checkbox = document.getElementById("myCheckbox");
            var span = document.getElementById("mySpan");

            if (checkbox.checked) {
                span.textContent = "UPDATE";
            } else {
                span.textContent = "";
            }
        }
    </script>
    <script>
        function updateValu2() {
            var checkbox = document.getElementById("myCheckbox2");
            var span = document.getElementById("mySpan2");
            var dateInfo = document.getElementById("dateInfo");
            if (checkbox.checked) {
                span.textContent = "(For " + dateInfo.textContent + ")";
            } else {
                span.textContent = "";
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // Add an event listener to the "Opening Status" dropdown
            $("#openingStatus").on("change", function() {
                // Get the selected value from the "Opening Status" dropdown
                const selectedValue = $(this).val();
                alert(selectedValue)

                // Find the corresponding option in the "Deleted At" dropdown and set it as selected
                $("#deletedAt").val(selectedValue);
            });
        });
    </script>
    <script>
        // Get references to the textarea and output div elements
        const textarea = document.getElementById('myTextarea');
        const outputcon = document.getElementById('outputcon');
        // Add an event listener to the textarea for the 'input' event
        textarea.addEventListener('input', function() {
            // Get the value from the textarea
            const textValue = textarea.value;
            // Update the content of the output div with the text value
            outputcon.textContent = textValue;
        });
        // Get references to the textarea and output div elements
        const textareaOpt = document.getElementById('myTextareaOpt');
        const outputcontentopt = document.getElementById('outputcontentopt');
        // Add an event listener to the textarea for the 'input' event
        textareaOpt.addEventListener('input', function() {
            // Get the value from the textarea
            const textValue2 = textareaOpt.value;
            // Update the content of the output div with the text value
            outputcontentopt.textContent = textValue2;
        });
    </script>
@endsection
