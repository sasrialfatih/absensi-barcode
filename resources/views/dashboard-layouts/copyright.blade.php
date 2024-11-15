<style>
    @media only screen and (max-width:480px) {
        #footer, .copyright {
            font-size: 8pt;
        }
    }
</style>

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>{{ env('NAMA_INSTANSI') . ' ' . env('DISTRICT_NAME') }}</span></strong>. All Rights
        Reserved
    </div>
    <div class="credits">
        <a href="" target="_blank"><strong>Developer by {{ env('DEVELOPER_NAME') }}</strong></a>
    </div>
</footer>
