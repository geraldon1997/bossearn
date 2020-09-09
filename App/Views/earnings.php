<div class="content">
<h1>earnings</h1>
<hr>
<div class="row text-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Bref</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Points: <?= number_format($data['bref']); ?> </b></div>
                        <div class="col-lg-6"><b>Cash : &#8358; <?= number_format($data['bref'] / 10); ?></b></div>
                    </div>
                    <hr>
                    
                    <?php if ($data['bref'] >= 30000) : ?>
                        <form method="post" action="<?= WITHDRAW; ?>">
                            <input type="hidden" name="withdraw" value="bref">
                            <button type="submit" class="btn">withdraw</button>
                        </form>
                    <?php endif; ?>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Bpoints</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Points : <?= number_format($data['bpoint']); ?> </b></div>
                        <div class="col-lg-6"><b>Cash : &#8358; <?= number_format($data['bpoint'] / 10); ?> </b></div>
                    </div>
                    <hr>
                    <?php if ($data['bpoint'] >= 100000) : ?>
                        <form method="post" action="<?= WITHDRAW; ?>">
                            <input type="hidden" name="withdraw" value="bpoint">
                            <button type="submit" class="btn">withdraw</button>
                        </form>
                    <?php endif; ?>
                    
                </div><!-- end newsletter -->
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->
</div>
</div>