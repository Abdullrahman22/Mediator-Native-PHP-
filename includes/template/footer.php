






        <!-------------------- CopyRights---------------------->
        <?php
        if( $pagetitle != "Inbox" ){
            ?>
            <div id="footer">
                <div class="container text-center">
                    <p class="social-links">
                        <a href="#"> <i class="fab fa-facebook-square"></i> </a>
                        <a href="#"> <i class="fab fa-twitter-square"></i> </a>
                        <a href="#"> <i class="fab fa-youtube-square"></i> </a>
                        <a href="#"> <i class="fab fa-instagram"></i> </a>
                    </p>
                    <p class="terms">
                        <a href="terms.php"> <?php echo lang("Terms Of Us"); ?>  </a> - <a href="privacy.php"> <?php echo lang("Privacy Policy"); ?>  </a>
                    </p>
                    <p class="copyright">
                        &copy; 2020 Mediator.Org
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- JQUERY Framwork -->
        <script src="assets/js/jquery.js"></script>
        
        <!-- Poper.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

        <!-- JQUERY Ui Framwork -
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        ->

        <!-- Multi select option -->
        <script src="assets/js/multi-input.js"></script>

        <!-- WOW Framwork -->
        <script src="assets/js/wow.min.js"></script>

        <!-- bootstrap Framwork -->
        <script src="assets/js/bootstrap.js"></script>

        <!-- owl-carousel Framwork -->
        <script src="assets/js/owl.carousel.min.js"></script>

        <!-- counter -->
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>

        <!-- counter -->
        <script src="assets/js/jquery.combostars.min.js"></script>

        <!-- Custom File -->
        <script src="assets/js/custom.js"></script>
 
 
        <!-- Chat File -->
        <?php
            if( $pagetitle == "Inbox" ){
                echo '<script src="assets/js/chat.js"></script>';
            }
        ?>

    </body>


</html>
