<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_manage_listings_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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


<!-- Dashboard Container -->
<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('user/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3><?= $this->lang->line('lang_manage__auction_listings_title') ?></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_manage_listings_title') ?></li>
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
							<h3><i class="icon-material-outline-assignment"></i> <?= $this->lang->line('lang_manage__auction_listings_sub') ?></h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<?php if(!empty($websitelistings)) { foreach ($websitelistings as $listing) { 

								if(in_array($listing['listingType'],array_column($platforms,'platform'))) { 
								
								?>
								
								<?php if($listing['sold_status'] === '1') { ?>	
								<li class="disabledBox">
								<?php } else { ?>
								<li>
								<?php } ?>
									<!-- Listing -->
									<div class="domains-listing width-adjustment">

										<!-- Listing Details -->
										<div class="domains-listing-details">

											<!-- Details -->
											<div class="domains-listing-description">
												<h3 class="domains-listing-title"><a href="<?php echo base_url().'single_auction/'.$listing['listingType'].'/'.$listing['id']; ?>"><?php if(isset($listing['website_BusinessName'])) echo $listing['website_BusinessName']; else if(isset($listing['tagline'])) echo $listing['tagline']; ?></a> <span class="dashboard-status-button green"><?php if(isset($listing['listingType'])) echo strtoupper($this->lang->line($listing['listingType'])); ?></span> <?php if($listing['sold_status'] === '0') { if($listing['status'] === '1')  { ?> <span class="dashboard-status-button green"><?= $this->lang->line('lang_active') ?></span></h3> <?php } else if ($listing['status'] === '3') { ?> <span class="dashboard-status-button yellow"><?= $this->lang->line('lang_expired') ?></span> <?php } else if ($listing['status'] === '2') {?> <span class="dashboard-status-button red"><?= $this->lang->line('lang_suspended') ?></span> <?php } } else { ?> <span class="dashboard-status-button yellow"><?= $this->lang->line('lang_user_sold') ?></span> <?php } ?>

												<!-- domains Listing Footer -->
												<div class="domains-listing-footer">
													<ul>
														<li><i class="icon-material-outline-access-time"></i> <?php if(!empty($listing['endingdays'])) echo $listing['endingdays']; ?> <?= $this->lang->line('lang_info_days') ?>, <?php if(!empty($listing['endinghours'])) echo $listing['endinghours']; ?> <?= $this->lang->line('lang_info_hours') ?> <?= $this->lang->line('lang_info_left') ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Task Details -->
									<ul class="dashboard-task-info">
										<li><strong><?php echo $listing['activecount']; ?></strong><span><?= $this->lang->line('lang_manage__auc_active_bids') ?></span></li>
										<li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$ '; ?> <?php if(isset($listing['averageBid'])) echo ($listing['averageBid']); else echo '0'; ?></strong><span><?= $this->lang->line('lang_manage_bids_avgb') ?></span></li>
										<li><strong><?php echo $listing['inactivecount']; ?></strong><span><?= $this->lang->line('lang_manage_bids_inactive') ?></span></li>
										<li><strong><?php echo $listing['rejectedcount']; ?></strong><span><?= $this->lang->line('lang_manage_bids_rejected') ?></span></li>
										<li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$ '; ?> <?php echo $listing['highestbid']; ?></strong><span><?= $this->lang->line('lang_manage_bids_highest') ?></span></li>
										<li><strong><?php echo $listing['highestbidder']; ?></strong><span><?= $this->lang->line('lang_manage_bids_highest_bidder') ?></span></li>
										<?php if($listing['highestbidrow'] > $listing['reservedprice']) { ?>
										<li><strong> <?= $this->lang->line('lang_manage_bids_yes') ?> </strong><span><?= $this->lang->line('lang_manage_bids_reserve_met') ?></span></li>
										<?php } else { ?>
										<li><strong> <?= $this->lang->line('lang_manage_bids_no') ?> </strong><span><?= $this->lang->line('lang_manage_bids_reserve_met') ?></span></li>	
										<?php }?>
									</ul>
									<!-- Buttons -->
									<div class="buttons-to-right always-visible margin-top-60">
										<a href="<?php echo base_url().'/user/manage_bidders/'.$listing['listingType'].'/'.$listing['id'] ?>" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> <?= $this->lang->line('lang_manage_bids_btn_approve') ?> <span class="button-info"><?php if(isset($listing['totalBidders'])) echo $listing['totalBidders'];?></span></a>
										<a href="<?php echo base_url().'/user/manage_bids/'.$listing['listingType'].'/'.$listing['id'] ?>" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> <?= $this->lang->line('lang_manage_bids_btn_manage') ?> <span class="button-info"><?php if(isset($listing['totalBids'])) echo $listing['totalBids'];?></span></a>
										<a href="<?php echo base_url().'user/edit_listings/'.$listing['listingType'].'/'.$listing['id']; ?>" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<?php if($listing['totalBids'] === '0' && $listing['totalBidders'] === '0') { ?>
											<a href="<?php echo base_url().'user/remove_listing/'.$listing['id']; ?>" class="button gray ripple-effect ico" title="Remove Listing" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
										<?php }?>
									</div>
								</li>
								<?php  } } } else echo $this->lang->line('lang_c_no_listings_avb'); ?>

								<!-- End Listing -->

							</ul>
						</div>
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