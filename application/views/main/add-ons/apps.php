<?php if(!empty($featuredApps)) { ?> 
<!----------------------------Ending Soon Title ------------------------------------------------------------------>
<div class="margin-top-1">
    <div class="container">
      
      <!---Section Title--->
      <div class="row">
        <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
          <h2 class="slippa-section-title dark">
            <?php echo $this->lang->line('lang_featured_apps_title'); ?>
          </h2>

          <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
            <?php echo $this->lang->line('lang_featured_apps_sub'); ?>
          </p>
        </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
      </div><!-- /.row -->
      <!-----Section Title--->

      <div class="main-content">
          <div class="section featureds">
                      
            <!-- featured-slider -->
            <div class="featured-slider carousel slide six_shows_one_move gp_products_carousel_wrapper">
            <div id="featured-apps" class="carousel-inner" role="listbox">
            <?php $i=1; foreach ($featuredApps as $featuredApp) { ?>              
            <!---slide --->
            <div class="item">
            <div class="col-md-12 gp_products_item">
            <div class="gp_products_inner">
              <div class="gp_products_item_image">
                <a href="<?php echo base_url().$featuredApp['listing_option'].'/'.$featuredApp['listing_type'].'/'.$featuredApp['id'];  ?>">
                  <img src="<?php if(isset($featuredApp['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$featuredApp['website_thumbnail'];  ?>" alt="<?php echo $featuredApp['website_thumbnail'] ?>"/>
                </a>
              </div>
              <div class="gp_products_item_caption">
                <ul class="gp_products_caption_name">
                  <li><b><a href="<?php echo base_url().$featuredApp['listing_option'].'/'.$featuredApp['listing_type'].'/'.$featuredApp['id'];  ?>"><?php echo $featuredApp['website_BusinessName']; ?></a></b></li>
                  <li><a href="<?php echo base_url().'user_profile/'.$featuredApp['username']?>"><?php echo $featuredApp['username'] ?></a></li>
                </ul>
                <ul class="gp_products_caption_rating">
                  <li><?php if(strpos($featuredApp['app_market'], 'google') !== false) echo 'Android'; else if(strpos($featuredApp['app_market'], 'apple') !== false) echo 'IOS'; else echo 'N/A'; ?></li>
                  <li class="pull-right"><a href="#"><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?><?php if(!empty($featuredApp['website_buynowprice'])) echo number_format(floatval($featuredApp['website_buynowprice']),2) ?></a></li>
                </ul>
              </div>
            </div>
            </div>
            </div>
            <?php  $i++; }  ?>         
                    
            </div><!-- featured-slider -->
            </div><!-- #featured-slider -->
          </div><!-- featureds -->
          <!--------------------------------------------------------------------------------------------------------------->
      </div>
  </div>
</div>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->




