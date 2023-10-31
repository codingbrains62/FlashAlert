@extends('frontend.layouts.app')
@section('content')
    <style>
        /* Add your custom styles here */
        .no-org-message {
            background-color: #ffcccc;
            /* Background color */
            color: #ff0000;
            /* Text color */
            padding: 10px;
            /* Padding */
            border: 1px solid #ff0000;
            /* Border */
            margin-top: 10px;
            /* Margin from the top */
            text-align: center;
            /* Center-align text */
            font-weight: bold;
            /* Bold text */
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <section>
        <div style="background: #c5e3ed">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="intro-box ">
                    <div class="intro-text d-flex justify-content-center align-items-center">
                        <h1> {{ str_replace('/', '-', $data['region'][0]['Description']) }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 scrollcls">
            <p class="text-center">For news or operating status, search below for your organization or click on a category.
            </p>
            <div class="bank-union my-4" id="scroll-text">
                <p>Please note that not all schools or organizations offer the Messenger subscription service. <br>
                    Those that do are marked with an asterisk (*) in the list below and if it is available, the
                    organization's main page will have a field for your email address.
                </p>
                <div class="search-result" id="org-search-result">
                    <div id="org-search-count"></div>
                    <div class="list org-box d-flex flex-wrap list-search-result"></div>
                </div>
                <div id="no-org-message" class="no-org-message" style="display: none;">
                    <p>No organizations found.</p>
                </div>
                <div class="org-list-result" id="org-list-result">
                    <div class="org-cat-name"></div>
                    <div class="list org-box d-flex flex-wrap orgs-list-result"></div>
                </div>
                <div class="search-bar">
                    <label class="form-label"><b>Search for Organization Name:</b></label>
                    <div class="d-flex">
                        <input class="srch-form" type="text" id="searchInput" placeholder="Search by organization...">
                        <button class="srch-btn">Search</button>
                    </div>
                </div>
                <div class="org-name my-4">
                    <p><b>Or Choose from these Organization Categories:</b></p>
                    <div class="org-box d-flex flex-wrap">
                        @foreach ($data['orgcat'] as $orgcat)
                            <a value="{{ $orgcat['id'] }}" href=""
                                onclick="getOrgDetails('{{ $orgcat['CatagoryName'] }}', '{{ $orgcat['id'] }}', {{ $orgcat['orgCount'] }})">{{ $orgcat['CatagoryName'] }}<span>({{ $orgcat['orgCount'] }})</span></a>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
        // Bind click event to search button with class "srch-btn"
        $('.srch-btn').click(function() {
            performSearch();
            $(".org-list-result").css("display", "none");
        });
        // Bind keypress event to input element with id "searchInput"
        $('#searchInput').keypress(function(event) {
            if (event.which === 13) { // Check if Enter key is pressed (key code 13)
                event.preventDefault(); // Prevent form submission
                performSearch();
                $(".org-list-result").css("display", "none");
            }
        });
        // Start function to perform search by organization name
        function performSearch() {

            var searchTerm = $('#searchInput').val();
            $.ajax({
                type: "POST",
                url: "{{ route('search.ByOrg') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    orgName: searchTerm,
                },
                success: function(data) {
                    //console.log(data);
                    var count = data.count;
                    var arrOrgName = data.arrOrgName;
                    if (count > 0) {
                        // Display the search results
                        $(".search-result").css("display", "block");
                        $("#org-search-count").html("<strong>Search Result:</strong> " + ' (total ' + count +
                            ' ' + (count === 1 ? 'organization' : 'organizations') + " found.)");
                        $(".list-search-result").html(arrOrgName);
                        $("#no-org-message").css("display",
                        "none"); // Hide the "No organizations found" message
                    } else {
                        // Display the "No organizations found" message
                        $("#no-org-message").css("display", "block");
                        $(".search-result").css("display", "none"); // Hide the search results
                    }
                    // Clear the input box
                    $('#searchInput').val('');
                }
            });




            // Get the offset top of the search result div
            scrollToElement(); // Call the function to scroll to the element with class .scrollcls
        };
        // End function to perform search organization by organization name
        // Start function to get organization List by click on organization category
        function getOrgDetails(orgcat, orgcatId, orgCount) {

            $(".search-result").css("display", "none");
            event.preventDefault(); // Prevent page reload
            var orgcatId = orgcatId;
            var orgcatName = orgcat;
            var orgCount = orgCount;
            var orgNameWithCount = '<b>' + orgcatName + '</b>' + ' (total ' + orgCount + ' ' + (orgCount === 1 ?
                'organization' : 'organizations') +
            ')'; // Concatenate orgcatName, "total", orgCount, and either "organization" or "organizations" based on the value of orgCount, with orgcatName wrapped in <strong> tag for bold styling 
            $.ajax({
                type: "POST",
                url: "{{ url('getorgData') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    orgCatId: orgcatId,
                    orgName: orgcatName,
                },
                success: function(data) {
                    if (data != "") {
                        $(".org-list-result").css("display", "block");
                        $(".orgs-list-result").html(data);
                        $(".org-cat-name").html(orgNameWithCount);
                    } else {
                        $(".org-list-result").css("display", "none");
                    }
                }
            });
            // Get the offset top of the search result div
            scrollToElement(); // Call the function to scroll to the element with class .scrollcls
        }
        // Start function to scroll to the element with class .scrollcls
        function scrollToElement() {
            var offsetTop = $(".scrollcls").offset().top;
            $("html, body").animate({
                scrollTop: offsetTop
            }, 100);
        }
        //End function to scroll to the element with class .scrollcls
    </script>
@endsection
