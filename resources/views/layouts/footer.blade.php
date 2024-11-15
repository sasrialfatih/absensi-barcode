<div class="">
    <footer id="footer" style="background-color: rgba(238, 255, 4, 0.418);">
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>{{ env('NAMA_INSTANSI') . ' ' . env('DISTRICT_NAME') }}</span></strong>. All
                Rights Reserved
            </div>
            <div class="credits">
                Designed by {{ env('DEVELOPER_NAME') }}
            </div>
        </div>
    </footer>
</div>

{{-- <div class="preloader"></div> --}}
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>


@livewireScripts
{{-- <script src="/vendor/turbolinks/turbolinks.js"></script>
<script src="/vendor/turbolinks/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}
{{-- scripts --}}
<script src="/vendor/aos/aos.js"></script>
<script>
    AOS.init();
</script>
<!-- bootstrap -->
{{-- <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

<!-- Templates -->
<!-- Vendor JS Files -->
<script src="/vendor/frontend-ui/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/vendor/frontend-ui/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/vendor/frontend-ui/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/vendor/frontend-ui/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/vendor/frontend-ui/vendor/waypoints/noframework.waypoints.js"></script>
<script src="/vendor/frontend-ui/vendor/php-email-form/validate.js"></script>
<script src="/vendor/frontend-ui/js/main.js"></script>



<script src='/vendor/purecounter-vanilla/purecounter_vanilla.js'></script>

{{-- calendar --}}
<script src="/vendor/calendar/datepicker.min.js"></script>

{{-- fakeloader --}}
<script src="/vendor/fakeloader/js/fakeLoader.min.js"></script>
<div class="fakeLoader"></div>
<script>
    $(document).ready(function() {
        $.fakeLoader({
            // bgColor: '#2ecc71',
            bgColor: 'rgba(0, 119, 255, 0.9',
            spinner: "spinner2"
        });
    });
</script>

</body>

</html>
