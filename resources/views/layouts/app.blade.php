<!DOCTYPE html>
    <html lang="en">
<head>
        <meta charset="utf-8" />
        <title>TruckBook</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <!-- third party css -->
        <link href="{{ asset('dashboard/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
 

        <!-- App css -->
        <link href="{{ asset('dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('dashboard/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

                <!-- third party css -->
        <link href="{{ asset('dashboard/assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/assets/css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/assets/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    </head>

        <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
   <div class="wrapper" style=" overflow: scroll;">
        @include('layouts.sidebar')
  <div class="content-page" style=" overflow: scroll;">
      @include('layouts.topbar')
      @yield('body')
    </div>


                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Tarachand Patel - +91 9584587577
                            </div>

                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>




        </div>


      <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="{{ asset('dashboard/assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor.min.js.map') }}"></script>
        <script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>

        <!-- third party js -->
        <script src="{{ asset('dashboard/assets/js/vendor/apexcharts.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{ asset('dashboard/assets/js/pages/demo.dashboard.js') }}"></script>
        <!-- end demo js-->


        <!-- third party js -->
        <script src="{{ asset('dashboard/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/buttons.print.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/dataTables.select.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{ asset('dashboard/assets/js/pages/demo.datatable-init.js') }}"></script>
        <!-- end demo js-->
        @yield('java_script')

        <script type="text/javascript">
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
            //Fetch Supplier List
        </script>
    </body>


</html>