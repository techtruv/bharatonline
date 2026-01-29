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
        
        <!-- Navbar css -->
        <link href="{{ asset('dashboard/assets/css/navbar.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Modern Forms CSS -->
        <link href="{{ asset('dashboard/assets/css/modern-forms.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
        
        <style>
            body {
                margin: 0;
                padding: 0;
            }
            
            .main-content {
                min-height: calc(100vh - 120px);
                padding-top: 2rem;
                padding-bottom: 2rem;
                background-color: #f5f7fa;
            }
            
            .main-content > .container-fluid {
                padding: 0 1rem;
            }
            
            @media (max-width: 768px) {
                .main-content {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                }
                
                .main-content > .container-fluid {
                    padding: 0 0.5rem;
                }
            }
        </style>

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
        @include('layouts.navbar')
        
        <div class="main-content">
            @yield('body')
        </div>

       

        <!-- bundle -->
        <script src="{{ asset('dashboard/assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>

        <!-- third party js -->
        <script src="{{ asset('dashboard/assets/js/vendor/apexcharts.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{ asset('dashboard/assets/js/pages/demo.dashboard.js') }}"></script>
        <!-- end demo js-->
        
        <!-- Prevent dashboard initialization on non-dashboard pages -->
        <script>
            if (typeof Dashboard !== 'undefined') {
                var originalInit = Dashboard.init;
                Dashboard.init = function() {
                    // Only run dashboard initialization on pages with dashboard elements
                    if ($('#dash-daterange, #revenue-chart, #high-performing-product, #average-sales').length > 0) {
                        originalInit.call(this);
                    }
                };
            }
        </script>

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
        
        <!-- Navbar JavaScript -->
        <script src="{{ asset('dashboard/assets/js/navbar.js') }}"></script>
        
        @yield('java_script')

        <script type="text/javascript">
            // Initialize Select2 on ready
            $(document).ready(function() {
                // Initialize Select2 for single select
                if (typeof jQuery !== 'undefined') {
                    $('.js-example-basic-single').select2();
                }
                
                // Wrap ApexCharts initialization to handle missing elements gracefully
                if (typeof Dashboard !== 'undefined' && Dashboard.initCharts) {
                    try {
                        // Only initialize charts if we have the dashboard page
                        var chartsExist = $('#revenue-chart').length > 0 || 
                                        $('#high-performing-product').length > 0 || 
                                        $('#average-sales').length > 0;
                        
                        if (chartsExist) {
                            Dashboard.initCharts();
                        }
                    } catch (e) {
                        console.warn('ApexCharts initialization warning:', e.message);
                    }
                }
            });
        </script>
    </body>


</html>