<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin_assets/bower_components/datatables.net-bs/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <link href="{{ asset('front_assets/images/FlashAlert-Icon.png') }}" rel="icon">
    <link href="{{ url('front_assets/images/FlashAlert-apple-touch.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400&family=Lovers+Quarrel&family=Poppins:ital,wght@0,100;0,400;0,500;0,700;1,400&family=Raleway:ital,wght@0,100;0,500;0,600;1,700&family=Roboto:wght@100;900&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
    <script src="{{ asset('admin_assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/spell/spellChecker.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .pagination-info {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            margin: 10px;
        }

        .current-page {
            font-weight: bold;
            color: #ff0000;
            /* red */
        }

        .first-item,
        .last-item,
        .total {
            font-weight: bold;
            color: #0000ff;
            /* blue */
        }

        .side-txt-blu {
            color: #6fd4ff !important;
        }

        .side-txt-blu:hover {
            color: #a8e5ff !important
        }

        .side-txt-green {
            color: #14df14 !important;
            font-weight: 400;
        }

        .side-txt-green:hover {
            color: #26b526 !important;
        }

        aside.main-sidebar {
            width: 140px;
        }
    </style>
</head>

<body class="hold-transition skin-blue fixed sidebar-mini fixed">
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
        <script>
            swal({
                title: "Opps!",
                text: "{{ Session::get('failed') }}",
                icon: "danger",
                timer: 3000
            });
        </script>
    @endif
    @php
        $showSidebar = Session::has('loginId'); // Check if the user is logged in
        if ($showSidebar) {
            $sidebarWidth = '235px'; // Width of the sidebar when shown
        } else {
            $sidebarWidth = '0'; // Width of the sidebar when hidden (set to 0)
        }
    @endphp
    @php
     if ($showSidebar){
        $data = Helper::getData('users', Session::get('loginId'));
     }
    @endphp
    <div class="wrapper">

        @include('backend.common.header')
        @if ($showSidebar)
            {{-- Only include the sidebar if the user is logged in --}}
            @include('backend.common.sidebar')
        @endif
        @yield('content')
        @include('backend.common.footer')
        <div class="control-sidebar-bg"></div>
    </div>
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('admin_assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/js/pages/dashboard2.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/js/demo.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('#region').on('change', function() {
            var id = this.value;
            url = "{{ route('get.org') }}"
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == 0) {
                        location.reload();
                    }
                    $("#showall").hide();
                    $("#showcategory").html(data);
                },
            });
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            if (confirm('Are you sure you want to delete this?')) {
                url = "{{ route('d.org') }}"
                $.ajax({
                    url: url,
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        window.location.href = data.url;
                    },
                });
            }
        });
        // $(document).on('click', '.edit', function(e) {
        //     e.preventDefault();
        //     let id = $(this).attr('id');
        //     // alert(id);
        //     $('.reedit').click();
        // });
        function showConfirmDialog(event) {
            event.preventDefault(); // Prevents the default behavior of the anchor tag

            swal({
                    title: "Are you sure?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Redirect to the specified URL
                        window.location.href = event.target.href;
                    }
                });
        }

        document.querySelector('.scrollToTopButton').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        jQuery(function() {
            jQuery('[data-toggle="popover"]').popover();
            jQuery('[data-toggle="tooltip"]').tooltip();
        })
    </script>
</body>

</html>
