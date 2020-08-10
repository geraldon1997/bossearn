<footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        
                        <div class="copyright">&copy; Bossearn 2020</div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop"></div>
        
    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="App/Assets/Js/share-button.min.js"></script>
    <script src="App/Assets/Js/jquery.min.js"></script>
    <script src="App/Assets/Js/tether.min.js"></script>
    <script src="App/Assets/Js/bootstrap.min.js"></script>
    <script src="App/Assets/Js/animate.js"></script>
    <script src="App/Assets/Js/custom.js"></script>
    <script>

        $( document ).ready(function() {
            
            new ShareButton({
                networks: {
                    whatsapp: {
                        before: function(e) {
                            this.url = $(e).attr('data-url'),
                            this.description = $(e).attr('data-description')
                        },
                        after: function(e) {
                            pid_val = $(e).attr('post-id')

                            $.ajax({
                            url: 'https://bossearn.com/addshare.php',
                            type: 'POST',
                            data : { 
                                pid : pid_val
                                }
                            })
                        }
                    },
                    facebook: {
                        before: function(e) {
                            this.url = $(e).attr('data-url'),
                            this.description = $(e).attr('data-description')
                        },
                        after: function(e) {
                            pid_val = $(e).attr('post-id')
                            
                            $.ajax({
                            url: 'http://bossearn.test/addshare.php',
                            type: 'POST',
                            data : {
                                pid : pid_val
                                }
                            })
                            
                        }
                    },
                    twitter: {
                        before: function(e) {
                            this.url = $(e).attr('data-url'),
                            this.description = $(e).attr('data-description')
                            
                        },
                        after: function(e) {;
                            pid_val = $(e).attr('post-id');
                            
                            $.ajax({
                            url: 'https://bossearn.com/addshare.php',
                            type: 'POST',
                            data : {
                                pid : pid_val
                                }
                            })
                              
                        }
                    }
                },
                ui: {
                    flyout: 'middle bottom'
                    }
            });
        });

    </script>
</body>
</html>