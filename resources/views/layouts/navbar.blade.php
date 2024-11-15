<style>
    #main-topbar {
        width: 100%;
        height: 200px;
        padding: 0px;
    }

    #img-topbar {
        width: 100%;
    }

    @media only screen and (max-width:480px) {
        #main-topbar {
            width: 100%;
            height: 80px;
            padding: 0px;
        }

        #img-topbar {
            height: 80px;
        }
    }
</style>

<div class="" id="container">
    <section id="main-topbar" style="">
        <img id="img-topbar" src="/assets/img/topbar_bg.jpg" class="img-fluid" style="width: 100%;">
    </section>


    <script>
        $(document).ready(function() {
            var windowsize = $(window).width();
            if (windowsize <= 480) {
                document.getElementById("container").classList.remove('container');
            }
        });
    </script>

</div>

