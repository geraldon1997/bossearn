<meta 
        property="og:title" 
        content="<?php
        if (isset($data['title'])) {
            echo $data['title'];
        } else {
            echo "Bossearn";
            var_dump($data);
        }?>" 
    />
    <meta 
        property="og:description"
        content="<?php
        if (isset($data['body'])) {
            echo substr($data['body'], 0, 200);
        } else {
            echo "Bossearn concept is a news sharing platform tiers of Bossearn income forum incorporated with Corporate Affairs Commission with registration number 3140896. We source first hand news on happenings within the country and around the globe from National papers, Google news, local and foreign bloggers to benefit our erudite readers.";
        }?>" 
    />
    <meta
        property="og:image"
        content="<?php
        if (isset($data['image'])) {
            echo 'https://bossearn.com/'.$data['image'];
        } else {
            echo ASSETS."/Images/logo.jpeg";
        }?>" 
    />

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