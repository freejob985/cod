<!-- all listing types start -->
    <div class="section margin-top-5">
        <div class="container">
            
            <!---Section Title--->
            <div class="row">
            <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
                <h2 class="slippa-section-title dark">
                    <?php echo $this->lang->line('lang_featured_title'); ?>
                </h2>
                <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
                    <?php echo $this->lang->line('lang_featured_title_sub'); ?>
                </p>
            </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
            </div><!-- /.row -->
            <!-----Section Title--->

            <!------RECENT LISTINGS---------> 
            <div class="margin-top-0">
                <div class="container">
                    <div class="main-content">
                        <div class="section featureds">
                        <?php if(!empty($recentlyAdded)) { ?>
                        <!--top heading--->
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title featured-top">
                                <h3><b><?php echo $this->lang->line('lang_recentlyadded_header'); ?></b></h3>
                            </div>
                        </div>
                        </div><!--/top heading--->
                        <?php } ?>
          
                        <!-- featured-slider -->
                        <div class="featured-slider">
                        <div id="recent-slider">
                        <?php $i=0; foreach ($recentlyAdded as $ad) { ?>
                            <div class="featured box-hover">

                                <span class="bookmark-icon"></span>
                                <!-- featured image -->
                                <div class="featured-image slippa-category-box slippa-rounded-10 slippa-p-20">
                                    <?php if($settings[0]['image_thumbnails'] === '1') { 
                                    if($ad['listing_type'] === 'website' && $settings[0]['active_domain_screenshots'] === '1') { ?>
                                    <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['screenshot'])) echo base_url().SCREENSHOTS.$ad['screenshot'].'.jpg';  ?>" alt="" class="img-screenshot-thumb"></a>
                                    <?php } else { ?> <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="" class="img-sponsored"></a> 
                                    <?php  } } else { ?>
                                    <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><div class="category-box-icon domian-bg-color color--<?php echo $i; ?> text-center f-size-28">.<?php if(isset($ad['extension'])) echo $ad['extension'];  ?></div></a>
                                    <?php } ?>

                                    <?php if($ad['listing_option'] === 'auction') { ?>
                                    <a href="#" class="auction" data-toggle="tooltip" data-placement="left" title="<?= $this->lang->line('lang_txt_auctions'); ?>"><i class="fas fa-gavel"></i></a>
                                    <?php } else { ?>
                                    <a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="<?= $this->lang->line('lang_txt_classified'); ?>"><i class="fab fa-adversal"></i></a>
                                    <?php } ?>
                                </div>
                    
                                <!-- ad-info -->
                                <div class="ad-info">
                                    <h2 class="item-title">
                                        <strong><a href="#"><?php if(isset($ad['website_BusinessName'])) echo $ad['website_BusinessName'];  ?></a></strong>
                                    </h2>
                                    <h4 class="item-price"><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?></span>  <?php if(isset($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice'])); else echo number_format(floatval($ad['website_buynowprice']));  ?>
                                    </h4>
                                </div><!-- ad-info -->
                    
                                <!-- ad-meta -->
                                <div class="ad-meta">
                                    <div class="meta-content">
                                        <span class="item-cat"><a href="#"><?php if(isset($ad['listing_type'])) echo strtoupper($this->lang->line($ad['listing_type']));  ?></a></span>
                                    </div>                  
                                    <!-- item-info-right -->
                                    <div class="user-option pull-right">
                                        <?php if($ad['user_id'] !== $this->session->userdata('user_id')) { ?>
                                            <?php if(!empty($ad['website_buynowprice'])) { ?>
                                            <a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$ad['id']; ?>" class="text-primary" data-toggle="tooltip" data-placement="top" title="<?= $this->lang->line('lang_txt__al_buy_now'); ?>"><i class="mdi mdi-cart-plus"></i></a>
                                            <?php } ?>
                                        <?php } else {  ?>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="<?= $this->lang->line('lang_txt__al_buy_now'); ?>" class="add-to-cart-own text-primary"><i class="mdi mdi-cart-plus"></i></a>  
                                        <?php } ?>
                                        <a href="<?php echo base_url().'user_profile/'.$ad['user_id'];  ?>" data-toggle="tooltip" data-placement="top" title="<?php if(isset($ad['username'])) echo $ad['username'];  ?>"><i class="fa fa-user"></i> </a>                     
                                    </div><!-- item-info-right -->
                                </div><!-- ad-meta -->
                            </div><!-- featured -->
                        <?php $i++; } ?>  
                        </div><!-- featured-slider -->
                        </div><!-- #featured-slider -->
                        <?php if(!empty($recentlyAdded)) { ?>
                        <?php } ?>
                    </div><!-- featureds -->
                </div>
            </div>
            </div><!--/RECENT LISTINGS------>

            <!------POPULAR LISTINGS---------> 
            <div class="margin-top-2">
                <div class="container">
                    <div class="main-content">
                        <div class="section featureds">
                        <?php if(!empty($popularAdded)) { ?>
                        <!--top heading--->
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title featured-top">
                                <h3><b><?php echo $this->lang->line('lang_popular_header'); ?></b></h3>
                            </div>
                        </div>
                        </div><!--/top heading--->
                        <?php } ?>
          
                        <!-- featured-slider -->
                        <div class="featured-slider">
                        <div id="popular-slider">
                        <?php $i=0; foreach ($popularAdded as $ad) { ?>
                            <div class="featured box-hover">
                                <span class="bookmark-icon"></span>

                                <!-- featured image -->
                                <div class="featured-image slippa-category-box slippa-rounded-10 slippa-p-20">
                                    <?php if($settings[0]['image_thumbnails'] === '1') { 
                                    if($ad['listing_type'] === 'website' && $settings[0]['active_domain_screenshots'] === '1') { ?>
                                    <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['screenshot'])) echo base_url().SCREENSHOTS.$ad['screenshot'].'.jpg';  ?>" alt="" class="img-screenshot-thumb"></a>
                                    <?php } else { ?> <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="" class="img-sponsored"></a> 
                                    <?php  } } else { ?>
                                    <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><div class="category-box-icon domian-bg-color color--<?php echo $i; ?> text-center f-size-28">.<?php if(isset($ad['extension'])) echo $ad['extension'];  ?></div></a>
                                    <?php } ?>

                                    <?php if($ad['listing_option'] === 'auction') { ?>
                                    <a href="#" class="auction" data-toggle="tooltip" data-placement="left" title="<?= $this->lang->line('lang_txt_auctions'); ?>"><i class="fas fa-gavel"></i></a>
                                    <?php } else { ?>
                                    <a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="<?= $this->lang->line('lang_txt_classified'); ?>"><i class="fab fa-adversal"></i></a>
                                    <?php } ?>
                                </div>
                    
                                <!-- ad-info -->
                                <div class="ad-info">
                                    <h2 class="item-title">
                                        <strong><a href="#"><?php if(isset($ad['website_BusinessName'])) echo $ad['website_BusinessName'];  ?></a></strong>
                                    </h2>
                                    <h4 class="item-price"><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?></span>  <?php if(isset($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice'])); else echo number_format(floatval($ad['website_buynowprice']));  ?>
                                    </h4>
                                </div><!-- ad-info -->
                    
                                <!-- ad-meta -->
                                <div class="ad-meta">
                                    <div class="meta-content">
                                        <span class="item-cat"><a href="#"><?php if(isset($ad['listing_type'])) echo strtoupper($this->lang->line($ad['listing_type']));  ?></a></span>
                                    </div>                  
                                    <!-- item-info-right -->
                                    <div class="user-option pull-right">
                                        <?php if($ad['user_id'] !== $this->session->userdata('user_id')) { ?>
                                            <?php if(!empty($ad['website_buynowprice'])) { ?>
                                            <a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$ad['id']; ?>" class="text-primary" data-toggle="tooltip" data-placement="top" title="<?= $this->lang->line('lang_txt__al_buy_now'); ?>"><i class="mdi mdi-cart-plus"></i></a>
                                            <?php } ?>
                                        <?php } else {  ?>
                                        <a href="#" class="add-to-cart-own text-primary"><i class="mdi mdi-cart-plus"></i></a>  
                                        <?php } ?>
                                        <a href="<?php echo base_url().'user_profile/'.$ad['user_id'];  ?>" data-toggle="tooltip" data-placement="top" title="<?php if(isset($ad['username'])) echo $ad['username'];  ?>"><i class="fa fa-user"></i> </a>                     
                                    </div><!-- item-info-right -->
                                </div><!-- ad-meta -->
                            </div><!-- featured -->
                        <?php $i++; } ?>  
                        </div><!-- featured-slider -->
                        </div><!-- #featured-slider -->
                        <?php if(!empty($popularAdded)) { ?>
                        <?php } ?>
                    </div><!-- featureds -->
                </div>
            </div>
            </div><!--/POPULAR LISTINGS------>

            <!------SOLD LISTINGS---------> 
            <?php if(!empty($soldDomains)) { ?>
            <div class="margin-top-2">
                <div class="container">
                    <div class="main-content">
                        <div class="section featureds">
                        <?php if(!empty($soldDomains)) { ?>
                        <!--top heading--->
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title featured-top">
                                <h3><b><?php echo $this->lang->line('lang_sold_header'); ?></b></h3>
                            </div>
                        </div>
                        </div><!--/top heading--->
                        <?php } ?>
          
                        <!-- featured-slider -->
                        <div class="featured-slider">
                        <div id="sold-slider">
                        <?php $i=0; foreach ($soldDomains as $ad) { ?>
                            <div class="featured box-hover">
                                <span class="bookmark-icon"></span>
                                
                                <!-- featured image -->
                                <div class="featured-image slippa-category-box slippa-rounded-10 slippa-p-20">
                                    <?php if($settings[0]['image_thumbnails'] === '1') { 
                                    if($ad['listing_type'] === 'website' && $settings[0]['active_domain_screenshots'] === '1') { ?>
                                    <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['screenshot'])) echo base_url().SCREENSHOTS.$ad['screenshot'].'.jpg';  ?>" alt="" class="img-screenshot-thumb"></a>
                                    <?php } else { ?> <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="" class="img-sponsored"></a> 
                                    <?php  } } else { ?>
                                    <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><div class="category-box-icon domian-bg-color color--<?php echo $i; ?> text-center f-size-28">.<?php if(isset($ad['extension'])) echo $ad['extension'];  ?></div></a>
                                    <?php } ?>
                                    <?php if($ad['listing_option'] === 'auction') { ?>
                                    <a href="#" class="auction" data-toggle="tooltip" data-placement="left" title="<?= $this->lang->line('lang_txt_auctions'); ?>"><i class="fas fa-gavel"></i></a>
                                    <?php } else { ?>
                                    <a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="<?= $this->lang->line('lang_txt_classified'); ?>"><i class="fab fa-adversal"></i></a>
                                    <?php } ?>
                                </div>
                    
                                <!-- ad-info -->
                                <div class="ad-info">
                                    <h2 class="item-title">
                                        <strong><a href="#"><?php if(isset($ad['website_BusinessName'])) echo $ad['website_BusinessName'];  ?></a></strong>
                                    </h2>
                                    <h4 class="item-price"><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?></span>  <?php if(isset($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice'])); else echo number_format(floatval($ad['website_buynowprice']));  ?>
                                    </h4>
                                </div><!-- ad-info -->
                    
                                <!-- ad-meta -->
                                <div class="ad-meta">
                                    <div class="meta-content">
                                        <span class="item-cat"><a href="#"><?php if(isset($ad['listing_type'])) echo strtoupper($this->lang->line($ad['listing_type']));  ?></a></span>
                                    </div>                  
                                    <!-- item-info-right -->
                                    <div class="user-option pull-right">
                                        <a href="<?php echo base_url().'user_profile/'.$ad['user_id'];  ?>" data-toggle="tooltip" data-placement="top" title="<?php if(isset($ad['username'])) echo $ad['username'];  ?>"><i class="fa fa-user"></i> </a>                     
                                    </div><!-- item-info-right -->
                                </div><!-- ad-meta -->
                            </div><!-- featured -->
                        <?php $i++; } ?>  
                        </div><!-- featured-slider -->
                        </div><!-- #featured-slider -->
                        <?php if(!empty($soldDomains)) { ?>
                        <?php } ?>
                    </div><!-- featureds -->
                </div>
            </div>
            </div><!--/SOLD LISTINGS------>
            <?php } ?>

    <!-- end row -->
    </div>
    <!-- end containar -->
</div>
<!-- all domain section -->



