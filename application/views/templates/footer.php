 <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="<?=$this->config->item('urlTwitter')?>" target="blank_">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=$this->config->item('urlFacebbok')?>" target="blank_">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=$this->config->item('urlGit')?>" target="blank_">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyleft ;) <i class="fa fa-code" aria-hidden="true"></i> FireStormCMS</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?=$appPublic?>/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$appPublic?>/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?=$appPublic?>/js/smoothproducts.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="<?=$appPublic?>/js/clean-blog.min.js"></script>
    <script type="text/javascript">
    /* wait for images to load */
    $(window).load( function() {
        $('.sp-wrap').smoothproducts();
    });
    </script>
    <style>
    .sp-wrap {
        
    }
    </style>
</body>

</html>
