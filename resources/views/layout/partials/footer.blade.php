    <!-- MDB -->
    <script src="{{ asset('assets/MDB5/js/mdb.umd.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <!-- Sweet Alert 2 -->
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <!-- Validation JS -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/twitter-bootstrap/bootstrap.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    @yield('scripts')
    </body>
    @section('scripts')
        <script>
            $(document).ready(function() {

            });
        </script>
    @endsection

    </html>
