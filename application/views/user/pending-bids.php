<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_pending_bids_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--User Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!--------------------------------------------------------------------------------------------------------------->


<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('user/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3><?= $this->lang->line('lang_pending_bids_title') ?></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_pending_bids_title') ?></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-business-center"></i> <?= $this->lang->line('lang_pending_bids_title') ?></h3>
						</div>

						<?php foreach ($groupedOffers as $listing) { ?>
						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<!-- domains Listing -->
									<div class="domains-listing">

										<!-- domains Listing Details -->
										<div class="domains-listing-details">

											<!-- Logo -->
											<a href="#" class="domains-listing-company-logo">
												<img src="<?php if(isset($listing['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing['website_thumbnail']; ?>" alt="">
											</a>

											<!-- Details -->
											<div class="domains-listing-description">
												<h3 class="domains-listing-title"><a href="#"><?php if(isset($listing['website_BusinessName'])) echo $listing['website_BusinessName']; else $listing['website_tagline'] ?></a><?php if($listing['listing_status'] === '1') echo '&nbsp;&nbsp;<span class="badge badge-secondary">'.$this->lang->line("lang_active").'</span>'; else if($listing['listing_status'] === '2') echo '&nbsp;&nbsp;<span class="badge badge-danger">'.$this->lang->line("lang_suspended") .'</span>';else if($listing['listing_status'] === '4') echo '&nbsp;&nbsp;<span class="badge badge-warning">'.$this->lang->line("lang_expired").'</span>';  ?></h3>

												<!-- domains Listing Footer -->
												<div class="domains-listing-footer">
													<ul>
														<li><i class="icon-material-outline-local-atm"></i><?php if(isset($listing['maxAmount'])) echo $listing['maxAmount']; ?></li>
														<li><i title="No of Offers" class="icon-material-outline-location-on"></i> <?php if(isset($listing['NOF'])) echo $listing['NOF']; ?></li>
														<li><i title="Listing Type" class="icon-material-outline-business-center"></i> <?php if(isset($listing['listing_type'])) echo $this->lang->line($listing['listing_type']); ?></li>
														<li><i title="Last Update Date" class="icon-material-outline-access-time"></i> <?php if(isset($listing['ago'])) echo $listing['ago']; ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="<?php echo base_url().'user/view_bids'.'/'.$listing['listing_id']; ?>" class="button green ripple-effect ico" title="view" data-tippy-placement="left"><i class="fa fa-eye"></i></a>
									</div>
								</li>

							</ul>
						</div>
						<?php } ?>
					</div>
				</div>


			</div>
			<!-- Row / End -->
			<!----------------------------------------------------------------------------------------------------------->
			<?php $this->load->view('user/includes/footer'); ?>
			<!----------------------------------------------------------------------------------------------------------->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>