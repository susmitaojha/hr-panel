<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>HR Admin</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

    <!--   Core JS Files   -->
    {{-- <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js')}}"></script>
    <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">


    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
      function gluToast(t0, t1, t2) {
            $('#toast0').html('<i class="iziToast-icon ico-'+t0+' revealIn"></i>');
            $('#toast1').html(t1);
            $('#toast2').html(t2);
            $('#toastholder').css('display', 'block');
            setTimeout(function() { $('#toastholder').css('display', 'none'); }, 5000);
        }
    function toastClose() {
            $('#toastholder').css('display', 'none');
        }
    function confirmDelete() {
        return Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(result => result.isConfirmed);
    }

    async function handleDelete(event, element) {
        event.preventDefault(); // Stop the link from navigating immediately
        const confirmed = await confirmDelete();
        if (confirmed) {
            window.location.href = element.href; // Redirect manually
        }
    }
    </script>
    <div class="iziToast-wrapper iziToast-wrapper-bottomRight" style="display:none;" id="toastholder"><div class="iziToast-capsule" style="height: auto;"><div data-izitoast-ref="1626628281411" class="iziToast fadeInUp iziToast-theme-light iziToast-color-red iziToast-animateInside iziToast-opened" id="SGVsbG8lMkMlMjB3b3JsZCFUaGlzJTIwYXdlc29tZSUyMHBsdWdpbiUyMGlzJTIwbWFkZSUyMGl6aVRvYXN0JTIwdG9hc3RyYmx1ZQ"><div class="iziToast-body" style="padding-left: 33px;"><span id="toast0"></span><div class="iziToast-texts"><strong class="iziToast-title slideIn" style="margin-right: 10px;" id="toast1">Hello, world!</strong><p class="iziToast-message slideIn" id="toast2">Your Toast</p></div><div></div></div><button type="button" class="iziToast-close" onclick="toastClose()"></button><div class="iziToast-progressbar"><div style="transition: width 5000ms linear 0s; width: 0%;"></div></div></div></div></div>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f4f6;
        }
        #calendar {
            height: 90%;
        }
    </style>
  </head>
  <body>
    <div class="wrapper">
<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="/home" class="logo">
              <!-- <img
                src="assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              /> -->
              <h1 style="color:white">HRMS</h1>
            </a>
            {{-- <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div> --}}
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  href="/home"
                  class="collapsed"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <!-- <span class="caret"></span> -->
                </a>
              </li>
              {{--<li class="nav-item active">
                <a
                  href="/attendence-list"
                  class="collapsed"
                >
                  <i class="fas fa-user"></i>
                  <p>Attandance</p>
                  <!-- <span class="caret"></span> -->
                </a>
              </li>--}}
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-users"></i>
                  <p>Employee</p><span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="/all-employee">
                            <span class="sub-item">All Employee</span>
                        </a>
                    </li>
                    {{-- <li>
                      <a href="/manager">
                        <span class="sub-item">Manager</span>
                      </a>
                    </li>
                    <li>
                      <a href="/team-lead">
                        <span class="sub-item">Team Lead</span>
                      </a>
                    </li>
                    <li>
                      <a href="/senior-employee">
                        <span class="sub-item">Senior Employee</span>
                      </a>
                    </li>
                    <li>
                      <a href="/junior-employee">
                        <span class="sub-item">Junior Employee</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#projectbase">
                  <i class="fas fa-users"></i>
                  <p>Project</p><span class="caret"></span>
                </a>
                <div class="collapse" id="projectbase">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="/view-project">
                            <span class="sub-item">All Project</span>
                        </a>
                    </li>
                  </ul>
                </div>
              </li>
           </ul>
          </div>
        </div>
      </div>
