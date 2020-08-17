<style>
    #bg{
        margin-top: 50px;
        width: 100%;
        height: 500px;
    }
    .post-img{
        height: 300px;
        width: 400px !important;
    }
    .recent-post-img{
        height: 50px
    }
  @media (max-width: 700px){
    #bg{
      width: 100%;
      height: 100%;
    }
  }
    .btn-news:hover{
        cursor: pointer;
        color: gold !important;
    }
    .btn-ep{
        background-color: orange !important;
        color: black !important;
        margin-bottom: 5px;
    }
    .btn-ep:hover{
        background-color: black !important;
        color: white !important;
    }
</style>
<img src="App/Assets/Images/b1.jpeg" alt="" id="bg">

<marquee><b>Welcome to BOSSEARN please do login or click the Register to enjoy</b></marquee>
<div style="width:100%; text-align: center;">
<a href="<?php echo REGISTER; ?>" class="btn" >Register</a>
<hr>
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <!-- <div class="page-wrapper"> -->
                            
                            <div class="blog-custom-build">
                            
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="news.php?news=" title="">
                                            <img src="" alt="" class="img-fluid post-img">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div>
                                            <!-- end hover -->
                                        </a>
                                    </div>
                                    <!-- end media -->
                                    <div class="blog-meta big-meta text-center">
                                        <div class="post-sharing">
                                            
                                        </div><!-- end post-sharing -->
                                        <h4 id="title" data-description="">title</h4>
                                        <p>news</p>
                                        <a href="https://bossearn.com/news.php?news=" class="btn" data-url="https://bossearn.com/news.php?news=" id="read">Read more</a>
                                        <hr class="invis">

                                            <a href="editpost.php?id=" class="btn btn-ep">edit post</a>
                                            <form method="post"  onsubmit="return confirm('Do you really want to delete this post ?');">
                                                <input type="hidden" name="pid" value="">
                                                <button type="submit" class="btn btn-ep">delete post</button>
                                            </form>

                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                            </div>
                            
                        <!-- </div> -->

                        <hr class="invis">


                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">


                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        
                                        <a href="news.php?news=" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="" alt="" class="img-fluid float-left recent-post-img">
                                                <h5 class="mb-1"></h5>
                                                <p></p>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
