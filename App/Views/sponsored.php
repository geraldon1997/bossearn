<?php

use App\Models\Role;

?>

<style>
    
    .post-img{
        height: 300px;
        width: 400px !important;
    }
    .recent-post-img{
        height: 50px
    }
  @media (max-width: 700px){
    
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

<div class="content">
<h1>Sponsored Posts</h1>
<hr>
        <section class="section lb">
            
        <div class="container">
            
                <div class="row">
                
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        
                    <?php foreach ($data[0] as $news) : ?>
                            <div class="blog-custom-build">
                            
                            
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="<?php echo READNEWSPAGE.$news['id']; ?>" title="<?php echo $news['title']; ?>">
                                            <img src="<?php echo '/'.$news['image']; ?>" id="image" class="img-fluid post-img" data-image="<?php echo 'https://bossearn.com/'.$news['image']; ?>">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div>
                                            <!-- end hover -->
                                        </a>
                                    </div>
                                    <!-- end media -->
                                    <div class="blog-meta big-meta text-center">
                                        <div class="post-sharing">
                                        <?php if ($news['date_posted'] > time()) : ?>
                                            <share-button data-url="<?php echo "https://bossearn.com".READNEWSPAGE.$news['id'].'/'.USERID; ?>">Share</share-button>
                                        <?php endif; ?>
                                        </div><!-- end post-sharing -->
                                        <h4 id="title" data-title="<?php echo $news['title']; ?>" data-id="<?php echo $news['id']; ?>"><?php echo $news['title']; ?></h4>
                                        <p id="desc" data-description="<?php echo substr($news['body'], 0, 200); ?>"><?php echo substr($news['body'], 0, 200); ?></p>
                                        <a href="<?php echo READNEWSPAGE.$news['id']; ?>" class="btn" id="read">Read more</a>
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
                                                               
                                
                            </div>
                            <hr class="invis">
                    <?php endforeach; ?>
                        
                    </div><!-- end col -->
                    
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">


                            <div class="widget">
                                <h2 class="widget-title">Recent Sponsored Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                    <?php foreach ($data[1] as $recent) : ?>
                                        <a href="<?php echo READNEWSPAGE.$recent['id']; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="<?php echo '/'.$recent['image']; ?>" alt="" class="img-fluid float-left recent-post-img">
                                                <i class="mb-1"><?php echo $recent['title'] ?></i>
                                                
                                            </div>
                                        </a>
                                        <hr>
                                    <?php endforeach; ?>
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                        </div> <!--end sidebar-->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

</div>