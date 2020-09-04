<?php
use App\Models\Earning;
use App\Models\User;
use App\Models\Point;

$userid = User::authid();
$subid = User::authinfo()['subscription_id'];
$previouspoint = Earning::bpoint();
$currentpoint = Point::point('subscription_id', $subid)[0]['news_click'];
$newpoint = $previouspoint + $currentpoint;

Earning::updateEarning('bpoint', $newpoint, $userid);
?>
<div class="content">


    <div class="blog-box wow fadeIn">
        <div class="post-media">
            <a href="" title="<?php echo $data['title']; ?>">
                <img src="<?php echo '/'.$data['image']; ?>" alt="" class="img-fluid post-img">
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
            <h4 id="title" data-description=""><?php echo $data['title']; ?></h4>
            <p><?php echo $data['body']; ?></p>
            
            <hr class="invis">

        </div><!-- end meta -->
    </div><!-- end blog-box -->
                            
                            

</div>