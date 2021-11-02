<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <meta name="theme-color" content="" />
    <meta name="author" content="" />
    <meta name="keyword" content="" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
            <link rel="stylesheet" href="{{ asset('css/blueimp-gallery.css') }}" />
                <link rel="stylesheet" href="{{ asset('css/bootstrap-theme-cosmo-indigo-rounded.css') }}" />
                    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}" />
                        <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}" />
                            <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" />
                                <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
                                @yield('pagecss')
                                @yield('plugins')
                                <script>
                                    var siteAddr = "{{ url('') }}/";
                                    var defaultPageLimit = 20;
                                    var csrfToken = "{{ csrf_token() }}";
                                    var requestErrorMessage = "Unable to complete request";
                                    $.ajaxSetup({
                                    headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                    }
                                    });
                                </script>
                                </head>
                                <?php
                                    $body_id = "index";
                                    if(auth()->check()){
                                    $body_id = "main";
                                    }
                                    $page_name = request()->segment(1) ?? 'index';
                                    $page_action = request()->segment(2) ?? 'index';
                                    $body_class = "$page_name-$page_action";
                                ?>
                                <body id="<?php echo $body_id ?>" class="with-login <?php echo $body_class ?>">
                                <div id="page-wrapper">
                                    <!-- Show progress bar when ajax upload-->
                                    <div id="ajax-progress-bar" class="progress"  style="display:none">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0"></div>
                                    </div>
                                    @include('appheader')
                                    <div id="main-content">
                                        <!-- Page Main Content Start -->
                                        <div id="page-content">
                                            @yield('content')
                                        </div>  
                                        <!-- Page Main Content [End] -->
                                        <!-- Page Footer Start -->
                                        @include('appfooter')
                                        <!-- Page Footer Ends -->
                                        <!-- Modal page for displaying ajax page -->
                                        <div id="main-page-modal" class="modal right fade" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0 reset-grids inline-page">
                                                    </div>
                                                    <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">&times;</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal page for displaying record delete prompt -->
                                        <div class="modal fade" id="delete-record-modal-confirm" tabindex="-1" role="dialog" aria-labelledby="delete-record-modal-confirm" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete record</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                        <span aria-hidden="true">&times;</span> 
                                                        </button>
                                                    </div>
                                                    <div id="delete-record-modal-msg" class="modal-body"></div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <a href="" id="delete-record-modal-btn" class="btn btn-primary">Delete</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Image Preview Component [Start] -->
                                        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                                            <div class="slides"></div>
                                            <h3 class="title"></h3>
                                            <a class="prev">‹</a>
                                            <a class="next">›</a>
                                            <a class="close">×</a>
                                            <a class="play-pause"></a>
                                            <ol class="indicator"></ol>
                                        </div>
                                        <!-- Image Preview Component [End] -->
                                        <template id="saving-indicator">
                                            <div class="p-2 text-center m-2 text-muted">
                                                <div class="lds-dual-ring"></div>
                                                <h4 class="p-3 mt-2 font-weight-light">Saving...</h4>
                                            </div>
                                        </template>
                                        <template id="loading-indicator">
                                            <div class="p-2 text-center d-flex justify-content-center">
                                                <span class="loader mr-3"></span>
                                                <span class="font-weight-light">Loading...</span>
                                            </div>
                                        </template>
                                    </div>
                                    <div id="app-toast-success" style="display: none;" class="toast-alert row bg-success text-white alert animated bounce fixed-alert">
                                        <div><i class="material-icons">check_circle</i></div>
                                        <div class="msg">Message here</div>
                                    </div>
                                    <div id="app-toast-danger" style="display: none;" class="toast-alert row alert bg-danger text-white animated shake fixed-alert">
                                        <div><i class="material-icons">error</i></div>
                                        <div class="msg">Message here</div>
                                    </div>
                                    @if(Session::has('success'))
                                    <div data-show-duration="5000" id="flashmsgholder" class="toast-alert row alert bg-success bounce text-white animated fixed-alert" role="alert">
                                        <div><i class="material-icons">check_circle</i></div>
                                        <div class="msg">{{ Session::get('success') }}</div>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                    @endif
                                    @if(Session::has('danger'))
                                    <div data-show-duration="5000" id="flashmsgholder" class="toast-alert row alert bg-danger shake text-white animated fixed-alert" role="alert">
                                        <div><i class="material-icons">error</i></div>
                                        <div class="msg">{{ Session::get('danger') }}</div>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                    @endif
                                </div>
                                <script>
                                    var navTopHeight = $('#topbar').outerHeight();
                                    document.body.style.paddingTop = navTopHeight + 'px';
                                    $('#sidebar').css('top', navTopHeight);
                                    $('#sidebar').css('height', 'calc(100vh - ' +  navTopHeight + ')');
                                    var state = sessionStorage.getItem("sidebar");
                                    if (state) {
                                    $('#sidebar, #main-content').addClass('active');
                                    } else {        
                                    $('#sidebar, #main-content').removeClass('active');
                                    }
                                    $('#sidebarCollapse').on('click', function () {
                                    $('#sidebar, #main-content').toggleClass('active');
                                    if($('#sidebar').hasClass("active")){
                                    sessionStorage.setItem("sidebar", state);
                                    }
                                    else{
                                    sessionStorage.removeItem("sidebar");
                                    }
                                });</script>
                                <script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('js/bootstrap-4.3.1.min.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('js/flatpickr.min.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('js/dropzone.min.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('js/page-scripts.js') }}"></script>
                                @yield('pagejs')
                                </body>
                                </html>