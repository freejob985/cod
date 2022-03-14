<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>
<!---meta tags---->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php if(!empty($listing_data[0]['website_metakeywords'])) echo implode(',', json_decode(html_entity_decode($listing_data[0]['website_metakeywords']),true)); ?>"/>
<meta name="description" content="<?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName'];?> - <?= $this->lang->line('lang_payments_for_sale');  ?> </title>
<meta name="og:title" content="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName'];?> - <?= $this->lang->line('lang_payments_for_sale');  ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($listing_data[0]['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing_data[0]['website_thumbnail']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | Domain Marketplace"/>
<meta name="og:description" content="<?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!---/meta tags---->
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
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php if(isset($platfrom[0]['platfrom']) && !empty($platfrom[0]['platfrom'])) echo ucfirst($platfrom[0]['platfrom']); ?> <?php if(isset($listing_data[0]['listing_type'])) echo $this->lang->line($listing_data[0]['listing_type']); ?> <?= $this->lang->line('lang_payments_for_sale');  ?></h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Page Content-->
<div class="container">
	<div class="row">
		<input type="hidden" name="listingidwebsite" id="listingidwebsite" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
		<div class="imil-box margin-bottom-30">
            <div class="slippa-box-style-2">
                <h4 class="f-size-36 f-size-xs-30 slippa-semiblod text-422"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?><?php if(!in_array($listing_data[0]['listing_type'], array('app','account'))) { ?><a  target="_blank" href="<?php if(!empty($listing_data[0]['website_BusinessName'])) echo '//'.$listing_data[0]['website_BusinessName'];  ?>"><span class="badge"><i class="fa fa-link" title="<?php echo $this->lang->line('lang_pop_link');  ?>" data-tippy-placement="top"></i></span></a> <?php } else { ?> <a  target="_blank" href="<?php if(!empty($listing_data[0]['app_url']) && $listing_data[0]['app_url'] !== 'n/a') echo $listing_data[0]['app_url'];  ?>"><span class="badge text-danger"><i class="fab fa-app-store" title="<?php echo $this->lang->line('lang_pop_link');  ?>" data-tippy-placement="top"></i></span></a> <?php } ?></h4>
                <?php if (in_array($listing_data[0]['listing_type'], array('app'))) { ?>
                <span class="badge badge-danger" title="<?php if(strpos($listing_data[0]['app_market'], 'google') !== false) echo $this->lang->line('lang_txt_android') ; else if(strpos($listing_data[0]['app_market'], 'apple') !== false) echo $this->lang->line('lang_txt_ios'); else echo $this->lang->line('lang_txt_na'); ?>" data-tippy-placement="top"><?php if(strpos($listing_data[0]['app_market'], 'google') !== false) echo $this->lang->line('lang_txt_android'); else if(strpos($listing_data[0]['app_market'], 'apple') !== false) echo $this->lang->line('lang_txt_ios'); else echo $this->lang->line('lang_txt_na'); ?></span>
            	<?php } else if(in_array($listing_data[0]['listing_type'], array('account'))) { ?>
            	<span class="badge badge-danger" title="<?php if(isset($platfrom[0]['platfrom_domain'])) echo ($platfrom[0]['platfrom_domain']); ?>" data-tippy-placement="top"><?php if(isset($platfrom[0]['platfrom'])) echo ($platfrom[0]['platfrom']); ?></span>
            	<?php } ?>
                <div class="text-center website-thumb">
  					<img src="<?php if(isset($listing_data[0]['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing_data[0]['website_thumbnail'];  ?>" class="rounded resize-icon" alt="<?php if(isset($listing_data[0]['website_thumbnail'])) echo $listing_data[0]['website_thumbnail'];  ?>">
				</div>   
               	<h5 class="f-size-18 slippa-light3"><?php if(isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?></h5>
                <div class="row margin-top-50">
                    <div class="domain-border col-lg-4">
                        <span class="d-block f-size-24 slippa-semiblod"><?php if(isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?> <?= $this->lang->line('lang_payments_text_years');  ?></span>
                        <span class="d-block f-size-16 slippa-light3"><?= $this->lang->line('lang_payments_text_age');  ?></span>
                    </div>

                    <div class="domain-border col-lg-4 media-body">
                    	<?php if (!in_array($listing_data[0]['listing_type'], array('account'))) { ?>
                         <span class="d-block f-size-24 slippa-semiblod"><img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtolower($listing_data[0]['business_registeredCountry']); ?>.svg" alt=""> <?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtoupper($listing_data[0]['business_registeredCountry']); ?></span>
                        <span class="d-block f-size-16 slippa-light3"><?= $this->lang->line('lang_payments_text_country');  ?></span>
                    	<?php } else { ?>
                    	<img class="flag" src="<?php echo base_url().CATEGORY_IMAGES ?>/<?php if(isset($platfrom[0]['platfrom_icon'])) echo strtolower($platfrom[0]['platfrom_icon']); ?>" alt=""> <?php if(isset($platfrom[0]['platfrom'])) echo strtoupper($platfrom[0]['platfrom']); ?></span>
                        <span class="d-block f-size-16 slippa-light3"><?= $this->lang->line('lang_payments_text_channel');  ?></span>
                    	<?php } ?>
                    </div>

                    <div class="col-lg-4">
                    	<?php if(in_array($listing_data[0]['listing_type'], array('domain','website'))) { ?>
                        	<span class="d-block f-size-24 slippa-semiblod"><?php if(!empty($alexaRank['globalRank'][0])) echo number_format($alexaRank['globalRank'][0]); else echo $this->lang->line('lang_txt_na'); ?></span>
                        	<span class="d-block f-size-16 slippa-light3"><?= $this->lang->line('lang_payments_text_alexa');  ?></span>
                        <?php } else { ?>
                        	<span class="d-block f-size-24 slippa-semiblod"><?php if(!empty($listing_data[0]['monthly_downloads'])) echo number_format($listing_data[0]['monthly_downloads']); else echo $this->lang->line('lang_txt_na'); ?></span>
                        	<?php if(in_array($listing_data[0]['listing_type'], array('app'))) { ?>
                        	<span class="d-block f-size-16 slippa-light3"><?= $this->lang->line('lang_payments_text_downloads');  ?></span>
                        	<?php } else {   ?>
                        	<span class="d-block f-size-16 slippa-light3"><?= $this->lang->line('lang_payments_text_likes');  ?> </span>
                        	<?php } ?>
                        	
                        <?php } ?>
                   </div>

                </div><!-- /.d-flex -->
            </div><!-- /.slippa-box-style-2 -->
            <div class="slippa-gradient-4 text-center f-size-18 slippa-semiblod padding-top-10 margin-bottom-10 padding-bottom-10 text-white">
                <?= $this->lang->line('lang_payments_auction_tag');  ?>
           	</div><!-- /.slippa-gradient-4 -->
        </div><!-- /.imil-box -->

        <div class="slippa-box-style-2 margin-bottom-30 slippa-dorder-off">
            <span class="f-size-18"><span class="slippa-strong rtl-right"><?= $this->lang->line('lang_payments_sponsored_tag');  ?> - </span> <a id="sponsored-dom" class="no-deco" href=""><span class="txt-rotate" data-period="2000" data-rotate=''></span></a></span>
        </div><!-- /.slippa-box-style-2 -->

        <?php if(!empty($listing_data[0]['website_cover'])) { ?>
        <!-- image slider --->
        <div id="carouselIndicators" class="carousel slide margin-bottom-30 border border-white" data-ride="carousel">
        	<ol class="carousel-indicators">
                <?php $i=0; foreach (json_decode($listing_data[0]['website_cover'],true) as $slider) { 
                    if($i === 0) {
                ?>    
        		<li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                <?php } else { ?>
        		<li data-target="#carouselIndicators" data-slide-to="<?=$i?>"></li>
                <?php } $i++; } ?>
        	</ol>
        	<div class="carousel-inner">
                <?php $i=0; foreach (json_decode($listing_data[0]['website_cover'],true) as $slider) { 
                    if($i === 0) { 
                ?>
        		<div class="carousel-item active">
        			<img class="d-block w-100" src="<?php if(isset($slider)) echo base_url().IMAGES_UPLOAD.$slider;  ?>" alt="slider_<?=$i?>">
        		</div>
                <?php } else { ?>
        		<div class="carousel-item">
        			<img class="d-block w-100" src="<?php if(isset($slider)) echo base_url().IMAGES_UPLOAD.$slider;  ?>" alt="slider_<?=$i?>">
        		</div>
                <?php } $i++; } ?>
        	</div>
        	<a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
        		<span class="sr-only"><?= $this->lang->line('lang_payments_previous');  ?></span>
        	</a>
        	<a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        		<span class="carousel-control-next-icon" aria-hidden="true"></span>
        		<span class="sr-only"><?= $this->lang->line('lang_payments_next');  ?></span>
        	</a>
        </div>
        <?php } ?>
        <!-- image slider --->

        <?php if($listing_data[0]['listing_type'] === 'website' && $settings[0]['active_domain_screenshots'] === '1') { ?>
        <!--website screenshot ---->
        <div class="imil-box">
        <div class="slippa-box-style-2 margin-bottom-30 content-right-offset">
        	<span class="f-size-24 d-block margin-bottom-30"><h3><b><?= $this->lang->line('lang_payments_text_screenshot');  ?></b></h3></span>
            <img src="<?php if(isset($listing_data[0]['screenshot'])) echo base_url().SCREENSHOTS.$listing_data[0]['screenshot'].'.jpg';  ?>" class="img-fluid text-center" style="width:100%;" alt="<?php if(isset($listing_data[0]['screenshot'])) echo $listing_data[0]['screenshot'].'.jpg';  ?>">
        </div><!-- /.slippa-box-style-2 -->
        </div>
        <!--/website screenshot ---->
    	<?php } ?>

        <!-- ad-section -->	
		<!--------------------------------------------------------------------------------------------------------------->
		<?php if(!empty($ads[0]['webpage_banner_720x90'])) { ?>					
		<div class="ad-section text-center margin-bottom-25">
			<?php print_r($ads[0]['webpage_banner_720x90']); ?>
		</div>
		<?php } ?>
		<!--------------------------------------------------------------------------------------------------------------->
		<!-- ad-section / End-->

        <div class="imil-box">
       	<div class="slippa-box-style-2 margin-bottom-30">
       	
       	<?php if(empty($this->session->userdata('user_id'))) { ?>
       		<?php if($listing_data[0]['listing_type'] !== 'app') { ?>
            <span class="f-size-24 d-block margin-bottom-30 rtl-setup"><h3><?= $this->lang->line('lang_payments_about_business');  ?></h3></span>
           	<?php } else { ?>
           	<span class="f-size-24 d-block margin-bottom-30"><h3><?= $this->lang->line('lang_payments_about_app');  ?></h3></span>
           	<?php } ?>
			<!-- Meta Description -->
			<p class="f-size-18 slippa-light3 line-height-34"><?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></p>
		<?php } ?>
       
			
		<?php if(!empty($this->session->userdata('user_id'))) { ?>

			<!-- Description -->
			<div class="single-page-section">
				<div class="row">
					<div class="col-md-12">
						<div class="content">
							<?php if($listing_data[0]['listing_type'] !== 'app') { ?>
							<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_about_business');  ?></h3>
							<?php } else { ?>
							<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_about_app');  ?></h3>
							<?php } ?>
							<p class="description-width"><?php if(isset($listing_data[0]['description'])) if(DECODE_DESCRIPTIONS) echo html_entity_decode($listing_data[0]['description']);  else echo ($listing_data[0]['description']); ?></p>
						</div>
					</div>
				</div>
			</div>
			
			<!-------------------------------------------------------------------------------------------------> 
            <?php $this->load->view('main/add-ons/google-analytics'); ?>
            <!------------------------------------------------------------------------------------------------->

            <!-------------------------------------------------------------------------------------------------> 
            <?php $this->load->view('main/add-ons/moz'); ?>
            <!------------------------------------------------------------------------------------------------->

			<?php if(!empty($listing_data[0]['website_how_make_money'])) { ?>
			<!-- How to make money -->
			<div class="single-page-section">
				<?php if($listing_data[0]['listing_type'] !== 'app') { ?>
				<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_q_1');  ?></h3>
				<?php } else { ?>
				<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_q_2');  ?></h3>
				<?php } ?>
				<p class="description-width"><?php echo $listing_data[0]['website_how_make_money']; ?></p>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_purchasing_fulfilment'])) { ?>
			<!-- Website Purchasing Fullfilment -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_q_3');  ?></h3>
				<p class="description-width"><?php echo $listing_data[0]['website_purchasing_fulfilment']; ?></p>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_whyselling'])) { ?>
			<!-- Why are you selling this business -->
			<div class="single-page-section">
				<?php if($listing_data[0]['listing_type'] !== 'app') { ?>
				<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_q_4');  ?></h3>
				<?php } else { ?>
				<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_q_5');  ?></h3>
				<?php } ?>
				<p class="description-width"><?php echo $listing_data[0]['website_whyselling']; ?></p>
			</div>
			<?php } ?>


			<?php if(!empty($listing_data[0]['website_suitsfor'])) { ?>
			<!-- Website is sutable for -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25"><?= $this->lang->line('lang_payments_q_6');  ?></h3>
				<p class="description-width"><?php echo $listing_data[0]['website_suitsfor']; ?></p>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['financial_uploadVisual']))  { ?>
			<!-- Atachments -->
			<div class="single-page-section">
				<h3><?= $this->lang->line('lang_payments_attachments');  ?></h3>
				<?php if(!empty($listing_data[0]['financial_uploadVisual']))  { ?>
				<div class="input-group margin-top-25">
					<div class="attachments-container">
						<a href="<?php echo base_url().FILES_UPLOAD.$listing_data[0]['financial_uploadVisual']; ?>" class="attachment-box ripple-effect"><span><?php echo $listing_data[0]['financial_uploadVisual']; ?></span><i><?php echo strtoupper(pathinfo($listing_data[0]['financial_uploadVisual'], PATHINFO_EXTENSION)); ?></i></a>
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($listing_data[0]['financial_uploadProfitLoss']))  { ?>
				<div class="input-group margin-top-25">
					<div class="attachments-container">
						<a href="<?php echo base_url().FILES_UPLOAD.$listing_data[0]['financial_uploadVisual']; ?>" class="attachment-box ripple-effect"><span><?php echo $listing_data[0]['financial_uploadProfitLoss'] ?></span><i><?php echo strtoupper(pathinfo($listing_data[0]['financial_uploadProfitLoss'], PATHINFO_EXTENSION)); ?></i></a>
					</div>
				</div>				
				<?php } ?>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_metakeywords'])) { ?>
			<!-- Tags -->
			<div class="single-page-section">
				<h3>Tags</h3>
				<div class="task-tags">
					<?php foreach (json_decode(html_entity_decode($listing_data[0]['website_metakeywords']),true) as $key) { ?>
						<span><?php echo $key ?></span>
					<?php }?>
				</div>
			</div>
			<?php } ?>

			<div class="clearfix"></div>
			
			<!-- Comments Area -->
			<div class="boxed-list margin-bottom-60">

				<?php if(!empty($this->session->userdata('user_id'))) { ?>
				<div class="boxed-list-headline">
					<h3><i class="fa fa-comments"></i> <?= $this->lang->line('lang_payments_comments');  ?></h3>
				</div>

				<div id="commentsSection"></div>
				<!--------------------------------------------------------------------------------------------------------------->
				<?php $this->load->view('main/add-ons/comments'); ?>
				<!--------------------------------------------------------------------------------------------------------------->
				<?php } else { ?>
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-lock"></i> <?= $this->lang->line('lang_payments_view_please');  ?> <a href="<?php echo base_url().'login' ?>"><?= $this->lang->line('lang_payments_link_login');  ?></a><?= $this->lang->line('lang_payments_view_comments');  ?></h3>
				</div>	
				<?php }?>
			</div>

		<?php } else { ?>
			<div class="boxed-list-headline">
				<h3><i class="icon-material-outline-lock"></i> <?= $this->lang->line('lang_payments_view_please');  ?> <a href="<?php echo base_url().'login' ?>"><?= $this->lang->line('lang_payments_link_login');  ?></a> <?= $this->lang->line('lang_payments_view_statics');  ?> </h3>
			</div>	
		<?php } ?>

		</div><!-- /.slippa-box-style-2 -->
        </div>

		</div>

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="slippa-gradient-2 text-center text-white slippa-light3 f-size-28 f-size-xs-24 margin-top-25 margin-bottom-25 margin-bottom-30">
                <?= $this->lang->line('lang_payments_view_this') ?> <?php if(isset($listing_data[0]['listing_type'])) echo ($this->lang->line($listing_data[0]['listing_type'])); ?> <?= $this->lang->line('lang_c_is_in'); ?> <?php if(isset($listing_data[0]['listing_option'])) echo ($this->lang->line($listing_data[0]['listing_option'])); ?>
            </div><!-- /.slippa-gradient-2 -->

			<div class="sidebar-container">

				<?php if ($auctionstatus ==='valid' ){?>
				<div class="countdown green margin-bottom-35"><?php if(!empty($nofdaysleft['days'])) echo $nofdaysleft['days']; ?> <?= $this->lang->line('lang_payments_view_days');  ?>, <?php if(!empty($nofdaysleft['hours'])) echo $nofdaysleft['hours']; ?><?= $this->lang->line('lang_payments_view_hours_left');  ?></div>
				<?php }else { ?>
				<div class="countdown bg-danger text-white margin-bottom-35"> <?= $this->lang->line('lang_payments_auction_ended');  ?> </div>
				<?php } ?>

				<div class="sidebar-widget">
					<div class="bidding-widget">
						<div class="bidding-headline centerButtons"><h3><?php echo strtoupper($this->lang->line('lang_single_page_bid_on_this'));  ?></h3></div>
						<div class="bidding-inner">
						<?php if($listing_data[0]['status'] !== '5') {
							if($listing_data[0]['sold_status'] === '0') { ?>
								
							<?php if ($auctionstatus ==='valid' ){?>
							<!-- Headline -->
							<span class="bidding-detail" style="float: right;"><a href="#sign-in-dialog" class="popup-with-zoom-anim"> <?php echo count($validBids); ?> <strong><?= $this->lang->line('lang_payments_view_bids');  ?> </a> </strong></span>
							<?php } ?>
							<span class="bidding-detail"><strong><?= $this->lang->line('lang_payments_current_price');  ?></strong></span>

							<!-- Price-->
							<div class="bidding-value"><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php echo number_format(floatval($currentPrice)); ?></div>
							<?php if ($auctionstatus ==='valid' ){?>
							<!-- Headline -->
							<span class="bidding-detail margin-top-30">Reserve: <strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(isset($listing_data[0]['website_reserveprice'])) echo $listing_data[0]['website_reserveprice']; ?></strong></span>
							<?php } ?>

							<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<?php if ($auctionstatus ==='valid' ){?>
							<!-- Button PLACE BID-->
							<a href="#small-dialog" class="button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim"><?php echo strtoupper($this->lang->line('lang_single_page_place_bid'));  ?> <i class="icon-material-outline-arrow-right-alt"></i></a>
							<?php } else { ?>	
							<?php } }?>

							<!-- Button -->
							<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<a href="#small-dialog-4" class="button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim"><?php echo strtoupper($this->lang->line('lang_payments_seller_contact'));  ?> <i class="icon-feather-mail"></i></a>
							<?php } else { ?>
							<div class="countdown alert alert-warning margin-bottom-35 margin-top-30"> <?= $this->lang->line('lang_payments_notice');  ?></div>
							<?php }?>

							<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<?php if(!empty($listing_data[0]['website_buynowprice'])) { ?>
								<!-- Button -->
								<a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$listing_data[0]['id']; ?>" class="button ripple-effect move-on-hover full-width margin-top-20"><span><?= $this->lang->line('lang_payments_buy_it');  ?> <?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(!empty($listing_data[0]['website_buynowprice'])) echo number_format($listing_data[0]['website_buynowprice']); ?></span></a>
							<?php } } ?>
						<?php } else { ?>
							<div class="alert alert-info text-dark margin-bottom-35 text-center"> <?= $this->lang->line('lang_payments_notice_sold');  ?> </div>
						<?php } } else { ?>
						<div class="alert alert-danger text-dark margin-bottom-35 text-center"> <?= $this->lang->line('lang_payments_notice_verified');  ?> </div>
						<?php } ?>
						</div>
						<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<div class="bidding-signup"><a href="#small-dialog-5" class="popup-with-zoom-anim"><?= $this->lang->line('lang_payments_notice_report');  ?></a></div>
						<?php } ?>
					</div>
				</div>

				<?php if(!empty($this->session->userdata('user_id'))) { ?>
				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="domains-overview">
						<div class="domains-overview-headline"><?= $this->lang->line('lang_payments_details_head');  ?></div>
						<div class="domains-overview-inner">
							<ul>
								<?php if($listing_data[0]['listing_type'] !== 'app') { ?>
								<li>
									<i class="fa fa-globe"></i>
									<span><?= $this->lang->line('lang_alexa_rank');  ?></span>
									<h5><?php if(!empty($alexaRank['globalRank'][0])) echo number_format($alexaRank['globalRank'][0]); else echo 'N/A'; ?></h5>
								</li>
								<?php } else { ?>
								<li>
									<i class="fas fa-arrow-circle-down"></i>
									<span><?= $this->lang->line('lang_payments_downloads');  ?></span>
									<h5><?php if(!empty($listing_data[0]['monthly_downloads'])) echo number_format($listing_data[0]['monthly_downloads']); else echo $this->lang->line('lang_txt_na');; ?></h5>
								</li>

								<li>
									<i class="fab fa-app-store"></i>
									<span><?= $this->lang->line('lang_payments_app');  ?></span>
									<h5><?php if(strpos($listing_data[0]['app_market'], 'google') !== false) echo $this->lang->line('lang_txt_android'); else if(strpos($listing_data[0]['app_market'], 'apple') !== false) echo $this->lang->line('lang_txt_ios'); else echo $this->lang->line('lang_txt_na'); ?></h5>
								</li>
								<?php } ?>

								<?php if($listing_data[0]['listing_type'] !== 'domain') { ?>
								<li>
									<i class="icon-material-outline-business-center"></i>
									<span><?php if(isset($listing_data[0]['listing_type'])) echo strtoupper($this->lang->line($listing_data[0]['listing_type'])); ?> <?= $this->lang->line('lang_payments_type');  ?></span>
									<h5> <a href="<?php echo base_url().'main/category/'.$selectedcategoriesData[0]['url_slug'] ?>"><?php if(isset($selectedcategoriesData[0]['c_name'])) echo $selectedcategoriesData[0]['c_name']; ?></h5>
								</li>
								<?php } ?>

								<li>
									<i class="icon-material-outline-access-time"></i>
									<span><?php if(isset($listing_data[0]['listing_type'])) echo strtoupper($this->lang->line($listing_data[0]['listing_type'])); ?> <?= $this->lang->line('lang_payments_age');  ?></span>
									<h5><?php if(isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?> <?= $this->lang->line('lang_c_years');  ?></h5>
								</li>

								<?php if($listing_data[0]['listing_type'] !== 'domain') { ?>
								<li>
									<i class="icon-feather-dollar-sign"></i>
									<span><?= $this->lang->line('lang_payments_netprofit');  ?></span>
									<h5><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(isset($listing_data[0]['annual_profit'])) echo number_format($listing_data[0]['annual_profit']); ?></h5>
								</li>
								<?php } ?>

								<li>
									<i class="icon-feather-users"></i>
									<span><?= $this->lang->line('lang_payments_views');  ?></span>
									<h5><?php if(isset($listing_data[0]['views'])) echo number_format(floatval($listing_data[0]['views'])); ?></h5>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>

				<!----About Seller --->
				<div class="sidebar-widget">
				<div class="seller-box margin-bottom-30">
                    <div class="slippa-box-style-2">
                        <h4 class="f-size-20 slippa-semiblod text-center"><?= $this->lang->line('lang_payments_seller_head');  ?></h4>
                        <div class="media  margin-top-30">
                            <div class="media-body text-center">
                            	<img src="<?php if(isset($ownerData[0]['thumbnail'])) echo base_url().USER_UPLOAD.$ownerData[0]['thumbnail']; ?>" alt="" class="msgavatar centerButtons">

                                <h5 class="margin-bottom-15 f-size-24 slippa-semiblod"><a href="<?php echo base_url().'user_profile/'.$ownerData[0]['username']?>"><?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></a></h5>
                                
                                <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtolower($listing_data[0]['business_registeredCountry']); ?>.svg" alt=""> <?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtoupper($listing_data[0]['business_registeredCountry']); ?>
                                <p class="margin-bottom-15 f-size-18 text-338">
                                    <div class="star-rating" data-rating="<?php if(isset($profileRatingsAvg[0]['avg_r']) && !empty($profileRatingsAvg[0]['avg_r'])) echo number_format(floatval($profileRatingsAvg[0]['avg_r']),1); else echo floatval(0); ?>"></div>
                                </p>
                                <?php if(!empty($this->session->userdata('user_id'))) { ?>
                                <p>
                                	<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
                                    	<a href="#small-dialog-4" class="slippa-btn slippa-outline-gradientL pill text-uppercase ull-width margin-top-30 popup-with-zoom-anim"><?= $this->lang->line('lang_payments_seller_contact');  ?></a>
                                    <?php } 
                            		} else { ?>
                            		<a href="#" class="slippa-btn slippa-outline-gradientL pill text-uppercase ull-width margin-top-30 own-listing"><?= $this->lang->line('lang_payments_seller_contact');  ?></a>
                            	<?php }?>
                            </div>
                        </div>
                    </div><!-- /.slippa-box-style-3 -->
                </div><!-- /.seller-box -->
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="media margin-bottom-30 info-box-text">
                    <img src="<?php echo base_url()?>assets/img/safe.png" class="slippa-mr-30 resize" alt="">
                    <div class="media-body">
                        <h5 class="mt-0 f-size-24 slippa-semiblod"><?= $this->lang->line('lang_payments_buyer_head');  ?></h5>
                        <p class="slippa-mb-0 f-size-18 line-height-34 slippa-light3">
                            <?php echo $this->lang->line('product_description_info1'); ?>
                        </p>
                    </div>
                	</div>

                	<div class="media margin-bottom-30 info-box-text">
                    <img src="<?php echo base_url()?>assets/img/migrate.png" class="slippa-mr-30" alt="">
                    <div class="media-body">
                        <h5 class="mt-0 f-size-24 slippa-semiblod"><?= $this->lang->line('lang_payments_transfer_head');  ?></h5>
                        <p class="slippa-mb-0 f-size-18 line-height-34 slippa-light3">
                            <?php echo $this->lang->line('product_description_info2'); ?>
                        </p>
                    </div>
                	</div>
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3><?= $this->lang->line('lang_btn_share');  ?></h3>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="<?php echo $this->lang->line('lang_pop_copy');  ?>" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span><?php echo $this->lang->line('lang_social_interesting');  ?> <strong><?php echo $this->lang->line('lang_social_share');  ?></strong></span>
							<ul class="share-buttons-icons">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" data-button-color="#3b5998" title="Share on <?php echo $this->lang->line('lang_social_facebook');  ?>" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/intent/tweet?text=<?php echo current_url(); ?>" data-button-color="#1da1f2" title="Share on <?php echo $this->lang->line('lang_social_Twitter');  ?>" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on <?php echo $this->lang->line('lang_social_Google');  ?>" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo current_url(); ?>" data-button-color="#0077b5" title="Share on <?php echo $this->lang->line('lang_social_linkedin');  ?>" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
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
<!----page scripts ---->
<script>textRotator();</script>
<?php if(!empty($this->session->userdata('user_id'))) { ?>
<script>loadDomainTrafficData('flotChart');</script>
<?php if(!empty($adsense)) { ?>
<script>loadAdsenseData('AdsenseChart');</script>
<script>loadAdsenseData('adsenseEarnings','bar','all',false);</script>
<script>loadAdsenseData('adsenseImpres','bar','impress',false);</script>
<?php } } ?>
<?php if($expiredStatus) { ?>
<script>disableScreen();</script>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</body>
</html>