<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php echo $this->lang->line('site_apps_keywords'); ?>"/>
<meta name="description" content="<?php echo $this->lang->line('site_apps_metadescription'); ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo $this->lang->line('site_apps'); ?> | <?php echo $this->lang->line('site_name'); ?></title>
<meta name="og:title" content="<?php echo $this->lang->line('site_apps'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo $this->lang->line('site_apps'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:description" content="<?php echo $this->lang->line('site_apps_metadescription'); ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/header'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>

<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php echo $this->lang->line('lang_bred_apps_page_main'); ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php echo $this->lang->line('lang_bred_apps_page_sub'); ?></h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Page Content-->
<div class="container">

    <!---Section Title--->
    <div class="container-fluid">
    <div class="jumbotron">
        <h2 class="slippa-section-title dark"><?php echo $this->lang->line('lang_apps_category_h2'); ?></h2>
        <p class="lead rtl-right"><?php echo $this->lang->line('lang_apps_category_p'); ?></p>
        <p><a href="<?php echo base_url()?>/apps" target="_blank" class="button ripple-effect move-on-hover full-width margin-top-20"><?php echo $this->lang->line('lang_apps_category_button'); ?></a></p>
    </div>
    </div>
    <!---/Section Title--->


    <?php if(!empty($sponsoredAds)) { ?>
    <!------Sponsored Ads---------> 
    <div class="margin-top-1 margin-bottom-25">
    <div class="container">
    <div class="main-content">
    <div class="section featureds">
    <!--top heading--->
    <div class="row">
        <div class="col-sm-12">
          <div class="section-title featured-top">
            <h3><b><?php echo $this->lang->line('lang_sponsored_apps'); ?></b></h3>
          </div>
        </div>
    </div><!--/top heading--->
          
    <!-- Sponsored-slider -->
    <div class="featured-slider carousel slide six_shows_one_move gp_products_carousel_wrapper">
    <div id="<?php if(isset($slider_name)) echo $slider_name;  ?>">
    <?php $i=1; foreach ($sponsoredAds as $ad) { ?>

    <!---slide --->
    <div class="item">
    <div class="col-md-12 gp_products_item">
    <div class="gp_products_inner">
    <div class="gp_products_item_image">
        <a href="<?php echo base_url().$ad['sell_type'].'/'.$ad['sell_web'].'/'.$ad['id'];  ?>">
            <img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="<?php echo $ad['website_thumbnail'] ?>"/>
        </a>
    </div>

    <div class="gp_products_item_caption">
        <ul class="gp_products_caption_name">
            <li><b><a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><?php echo substr($ad['website_BusinessName'], 0, 12); ?></a></b></li>
            <li><a href="<?php echo base_url().'user_profile/'.$ad['username']?>"><?php echo $ad['username'] ?></a></li>
        </ul>

        <ul class="gp_products_caption_rating">
            <li><?php if(strpos($ad['app_market'], 'google') !== false) echo $this->lang->line('lang_txt_android'); else if(strpos($ad['app_market'], 'apple') !== false) echo $this->lang->line('lang_txt_ios'); else echo $this->lang->line('lang_txt_na'); ?></li>
            <li class="pull-right"><a href="#"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(!empty($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice']),2) ?></a></li>
        </ul>
    </div>
    </div>
    </div>
    </div>
    <?php  $i++; }  ?>     

    </div><!-- featured-slider -->
    </div><!-- #featured-slider -->
    </div><!-- featureds -->
    </div>

    </div>
    </div><!--/Sponsored Ads------>
    <?php } ?>

    <?php if(!empty($featuredDomains)) { ?>
    <!------Featured Domains---------> 
    <div class="margin-top-1">
    <div class="container">
    <div class="main-content">
    <div class="section featureds">
    <!--top heading--->
    <div class="row">
        <div class="col-sm-12">
          <div class="section-title featured-top">
            <h3><b><?php echo $this->lang->line('lang_featured_apps'); ?></b></h3>
          </div>
        </div>
    </div><!--/top heading--->
          
    <!-- Sponsored-slider -->
    <div class="featured-slider carousel slide six_shows_one_move gp_products_carousel_wrapper">
    <div id="<?php if(isset($slider_feat_name)) echo $slider_feat_name;  ?>">
    <?php $i=1; foreach ($featuredDomains as $ad) { ?>
    <!---slide --->
    <div class="item">
    <div class="col-md-12 gp_products_item">
    <div class="gp_products_inner">
    <div class="gp_products_item_image">
        <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>">
            <img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="<?php echo $ad['website_thumbnail'] ?>"/>
        </a>
    </div>

    <div class="gp_products_item_caption">
        <ul class="gp_products_caption_name">
            <li><b><a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><?php echo substr($ad['website_BusinessName'], 0, 12); ?></a></b></li>
            <li><a href="<?php echo base_url().'user_profile/'.$ad['username']?>"><?php echo $ad['username'] ?></a></li>
        </ul>

        <ul class="gp_products_caption_rating">
            <li><?php if(strpos($ad['app_market'], 'google') !== false) echo $this->lang->line('lang_txt_android'); else if(strpos($ad['app_market'], 'apple') !== false) echo $this->lang->line('lang_txt_ios'); else echo $this->lang->line('lang_txt_na');; ?></li>
            <li class="pull-right"><a href="#"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(!empty($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice']),2) ?></a></li>
        </ul>
    </div>
    </div>
    </div>
    </div>
    <?php  $i++; }  ?>  

    </div><!-- featured-slider -->
    </div><!-- #featured-slider -->
    </div><!-- featureds -->
    </div>

    </div>
    </div><!--/Featured Domains------>
    <?php } ?>


    <!-- ad-section --> 
    <!-------------------------------------------------------------------------------------------------------------->
    <?php if(!empty($ads[0]['webpage_banner_720x90'])) { ?>                 
        <div class="ad-section text-center margin-bottom-25">
            <?php print_r($ads[0]['webpage_banner_720x90']); ?>
        </div>
    <?php } ?>
    <!--------------------------------------------------------------------------------------------------------------->
    <!-- ad-section / End-->

    <!-- Featured Domains -->   
    <!--------------------------------------------------------------------------------------------------------------->
    <?php $this->load->view('main/add-ons/domains-listings'); ?>
    <!--------------------------------------------------------------------------------------------------------------->
    <!-- Featured Domains / End-->
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footer'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</div>
<!-- Wrapper / End -->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>