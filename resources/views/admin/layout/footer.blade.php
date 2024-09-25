
<!-- /.content-wrapper -->
<footer class="main-footer">
    <p>&copy; <span id="currentYear"></span> CanGrow Online. All rights reserved.</p>

</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->



</div> <!-- end of wrapper div -->


<!-- jQuery -->
<script src=" {{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script src="{{ asset('dist/js/editor.js') }}"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Bootstrap 4 rtl -->
<script src="{{ asset('plugins/bootstrap/js/cdn.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src=" {{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src=" {{ asset('plugins/sparklines/sparkline.js') }} "></script>
<!-- JQVMap -->
<script src=" {{ asset('plugins/jqvmap/jquery.vmap.min.js') }} "></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js') }} "></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }} "></script>
<!-- daterangepicker -->
<script src=" {{ asset('plugins/moment/moment.min.js') }} "></script>
<script src=" {{ asset('plugins/daterangepicker/daterangepicker.js') }} "></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=" {{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }} "></script>
<!-- Summernote -->
<script src=" {{ asset('plugins/summernote/summernote-bs4.min.js') }} "></script>
<!-- overlayScrollbars -->
<script src=" {{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }} "></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" {{ asset('dist/js/pages/dashboard.js') }} "></script>
<!-- AdminLTE for demo purposes -->
<script src=" {{ asset('dist/js/demo.js') }} "></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        showSpinner();
        var year = new Date().getFullYear();
        document.getElementById('currentYear').textContent = year;


        // // Get the current URL path
        // var url = window.location.pathname;

        // // Get all navigation links
        // var navLinks = document.querySelectorAll('.nav-item a');

        // // Loop through each navigation link
        // navLinks.forEach(function(link) {
        //     var linkUrl = new URL(link.href);
        //     // console.log(link);
        // // Check if the link's href matches the current URL
        //     if (linkUrl.pathname === url) {
        //         // Add the "active" class to the parent list item
        //         link.classList.add('active');

        //     }
        // });




    });

    // Function to show the spinner overlay
    function showSpinner() {
        document.getElementById('spinner-overlay').style.display = 'flex';
    }

    // Function to hide the spinner overlay
    function hideSpinner() {
        document.getElementById('spinner-overlay').style.display = 'none';
    }

    // Hide spinner when all resources are loaded
    window.addEventListener('load', function() {
        hideSpinner();
    });












</script>

{{--<script src="{{asset('dist/js/ckeditor.js')}}"></script>--}}




@yield('scripts')


</body>
</html>
