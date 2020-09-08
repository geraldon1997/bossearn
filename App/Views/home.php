
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

<?php

use App\Models\Role;

if (!isset($_SESSION['uname'])) : ?>
<marquee><b>Welcome to BOSSEARN please do login or click the Register to enjoy</b></marquee>
<div style="width:100%; text-align: center;">

<a href="<?php echo REGISTER; ?>" class="btn" >Register</a>
<?php endif; ?>
<hr>
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <!-- <div class="page-wrapper"> -->
                            
                            <div class="blog-custom-build">
                            
                            <?php foreach ($data[0] as $news) : ?>
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="news.php?news=" title="<?php echo $news['title']; ?>">
                                            <img src="<?php echo $news['image']; ?>" alt="" class="img-fluid post-img">
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
                                        <h4 id="title" data-description=""><?php echo $news['title']; ?></h4>
                                        <p><?php echo substr($news['body'], 0, 200); ?></p>
                                        <a href="<?php echo READNEWSPAGE.$news['id']; ?>" class="btn" data-url="<?php echo READNEWSPAGE.$news['id']; ?>" id="read">Read more</a>
                                        <hr class="invis">

                                        <?php if (isset($_SESSION['uname']) && Role::role() === 'admin') : ?>
                                            <a href="<?php echo EDITNEWSPAGE.$news['id']; ?>" class="btn btn-ep">edit post</a>
                                            <form method="post" action="<?php echo DELETE_POST; ?>"  onsubmit="return confirm('Do you really want to delete this post ?');">
                                                <input type="hidden" name="pid" value="<?php echo $news['id']; ?>">
                                                <button type="submit" class="btn btn-ep">delete post</button>
                                            </form>
                                        <?php endif; ?>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            
                            <?php endforeach; ?>
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
                                    <?php foreach ($data[1] as $recent) : ?>
                                        <a href="<?php echo READNEWSPAGE.$recent['id']; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="<?php echo '/'.$recent['image']; ?>" alt="" class="img-fluid float-left recent-post-img">
                                                <h5 class="mb-1"><?php echo $recent['title'] ?></h5>
                                                <small><?php echo substr($recent['body'], 0, 25); ?></small>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
