<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_manage_bids_title') ?> | <?php echo $this->lang->line('site_name') ?>| <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
				<h3><?= $this->lang->line('lang_manage_bids_title') ?></h3>
				<span class="margin-top-7"><?= $this->lang->line('lang_manage_bids_for') ?> <a href="<?php echo base_url().'single_auction/'.$listingType.'/'.$listing_data[0]['id']; ?>"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; else if(isset($listing_data[0]['tagline'])) echo $listing_data[0]['tagline']; ?></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_manage_bids_title') ?></li>
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
							<h3><i class="icon-material-outline-supervisor-account"></i> <?php echo count($bids).' '.$this->lang->line('lang_manage_bids'); ?></h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">

								<!------Reserve Met ------------------------------------------->
								<li class="centerButtons">
									
										<?php if(!empty($websitelistings)) { foreach ($websitelistings as $listing) { ?>
									
										<li>
											<!-- Listing -->
											<div class="domains-listing width-adjustment">

												<!-- Listing Details -->
												<div class="domains-listing-details">

													<!-- Details -->
													<div class="domains-listing-description">
														<h3 class="domains-listing-title"><a href="<?php echo base_url().'single_auction/'.$listing['listingType'].'/'.$listing['id']; ?>"><?php if(isset($listing['website_BusinessName'])) echo $listing['website_BusinessName']; else if(isset($listing['tagline'])) echo $listing['tagline']; ?></a> <span class="dashboard-status-button green"><?php if(isset($listing['listingType'])) echo strtoupper($this->lang->line($listing['listingType'])); ?></span> <?php if($listing['status'] === '1')  { if($auctionstatus ==='valid') { ?> <span class="dashboard-status-button green"><?= $this->lang->line('lang_active') ?></span></h3> <?php } else { ?> <span class="dashboard-status-button red"><?= $this->lang->line('lang_ended') ?></span></h3> <?php } } else if ($listing['status'] === '3') { ?> <span class="dashboard-status-button yellow"><?= $this->lang->line('lang_expired') ?></span> <?php } else if ($listing['status'] === '2') {?> <span class="dashboard-status-button red"><?= $this->lang->line('lang_suspended') ?></span> <?php } ?>

														<!-- domains Listing Footer -->
														<div class="domains-listing-footer">
															<ul>
																<?php if($auctionstatus ==='valid') { ?> 
																<li><i class="icon-material-outline-access-time"></i> <?php if(!empty($listing['endingdays'])) echo $listing['endingdays']; ?> <?= $this->lang->line('lang_info_days') ?>, <?php if(!empty($listing['endinghours'])) echo $listing['endinghours']; ?> <?= $this->lang->line('lang_info_hours') ?> <?= $this->lang->line('lang_info_left') ?></li>
																<?php } ?>
															</ul>
														</div>
													</div>
												</div>
											</div>
									
											<!-- Task Details -->
											<ul class="dashboard-task-info">
												<li><strong><?php echo $listing['activecount']; ?></strong><span>Active Bids</span></li>
												<li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(isset($listing['averageBid'])) echo ($listing['averageBid']); else echo '0'; ?></strong><span><?= $this->lang->line('lang_manage_bids_avgb') ?></span></li>
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
												<a href="<?php echo base_url().'user/edit_listings/'.$listing['listingType'].'/'.$listing['id']; ?>" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
												<?php if($listing['totalBids'] === '0' && $listing['totalBidders'] === '0') { ?>
													<a href="<?php echo base_url().'user/remove_listing/'.$listing['id']; ?>" class="button gray ripple-effect ico" title="Remove Listing" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
												<?php }?>
											</div>
										</li>
										<?php } } ?>
										<!-- End Listing -->
								
								</li>
								<!------/Reserve Met ------------------------------------------->
								<!----Starts----->
								<?php foreach ($bids as $bid) { ?>

								<?php if(isset($bid['highestbidderid']) && !empty($bid['highestbidderid'])) { ?>
								<?php if ($auctionstatus ==='valid' ){?>
									<li class="domains-box active bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
								<?php } else { ?>
								<?php if($bid['reserve'] === '1') { ?>
									<li class="domains-box active won bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
								<?php } else { ?>
									<li class="domains-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
								<?php } }?>
									<div class="lable text-center pt-2 pb-2">
                                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                                        	<?php if ($auctionstatus ==='valid' ){?>
                                            	<li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        	<?php } else { ?>
                                        	<?php if($bid['reserve'] === '1') { ?>
                                        		<li class="list-inline-item"><i class="mdi mdi-crown"></i></li>	
                                        	<?php } else { ?>
                                        		<li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        	<?php } } ?>
                                        </ul>
                                   </div>
                               	<?php } else { ?>
                               		<?php if ($auctionstatus ==='invalid' ){?>
                               			<li class="domains-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden disabledBox">	
                               			<?php } else { ?>
                               			<li class="domains-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">
                               			<?php } ?>
                               	<?php } ?>
									<!-- Overview -->
									<div class="seller-overview manage-candidates">
										<div class="seller-overview-inner">

											<!-- Avatar -->
											<div class="seller-avatar">
												<div class="verified-badge"></div>
												<a href="#"><img src="<?php if(isset($bid['thumbnail'])) echo base_url().USER_UPLOAD.$bid['thumbnail']; ?>" alt=""></a>
											</div>

											<!-- Name -->
											<div class="seller-name">
												<h4><a href="#"><?php if(isset($bid['firstname'])) echo $bid['firstname'].' '.$bid['lastname']; ?> <img class="flag" src="images/flags/de.svg" alt="" title="<?php if(isset($bid['user_country'])) echo $bid['user_country']; ?>" data-tippy-placement="top"></a><?php if(isset($bid['highestbidderid']) && !empty($bid['highestbidderid'])) { ?><span id="FirstStep" class="badge badge-success text-white"><?= $this->lang->line('lang_manage_bids_highest'); ?> </span> <?php } ?></h4>

												<!-- Details -->
												<?php if($settings[0]['hide_useremail'] === '1') { ?>
												<span class="seller-detail-item"><a href="#"><i class="icon-feather-mail"></i> <span id="FirstStep" class="badge badge-warning"><?= $this->lang->line('lang_invoice_status_hidden'); ?> </span></a></span>
												<?php } else { ?>
												<span class="seller-detail-item"><a href="#"><i class="icon-feather-mail"></i> <?php if(isset($bid['email'])) echo $bid['email']; ?></a></span>
												<?php } ?>

												<?php if($bid['reserve'] === '1') { ?>
												<span class="seller-detail-item"><a href="#"><i class="icon-feather-mail"></i> <span id="FirstStep" class="badge badge-warning text-white"><?= $this->lang->line('lang_manage_bids_reserve_met'); ?> </span></a></span>
												<?php } ?>

												<!-- Rating -->
												<div class="seller-rating">
													<div class="star-rating" data-rating="<?php if(isset($bid['ratings'])) echo $bid['ratings']; ?>"></div>
												</div>

												<!-- Bid Details -->
												<ul class="dashboard-task-info bid-info">
													<li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($bid['bid_amount'])) echo number_format($bid['bid_amount']); ?></strong><span><?= $this->lang->line('lang_invoice_bid_amount'); ?></span></li>
													<li><strong><?php if(isset($bid['nfd'])) echo $bid['nfd']; ?> <?= $this->lang->line('lang_c_listing_days'); ?></strong><span> <?= $this->lang->line('lang_txt__al_ago'); ?></span></li>
												</ul>

												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
													<?php if ($auctionstatus ==='invalid' ){
													if(isset($bid['highestbidderid']) && !empty($bid['highestbidderid'])) { ?>
													<?php if($bid['reserve'] === '1') { ?>
													<a href="#small-dialog-9" data-bidid="<?php if(isset($bid['id'])) echo $bid['id']; ?>" data-bidder="<?php if(isset($bid['firstname'])) echo $bid['firstname'].' '.$bid['lastname']; ?>" data-bidcur="<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>" data-escrow="<?php if(isset($bid['escrow_email'])) echo $bid['escrow_email']; ?>" data-seller-escrow="<?php if(isset($seller_info[0]['escrow_email'])) echo $seller_info[0]['escrow_email']; ?>" data-bidamount="<?php if(isset($bid['bid_amount'])) echo $bid['bid_amount']; ?>" class="popup-with-open-contract button ripple-effect"><i class="icon-material-outline-check"></i> <?= $this->lang->line('lang_manage_winning_bid'); ?></a>
													<?php } } } ?>
													<a href="#small-dialog-3" data-bidid="<?php if(isset($bid['id'])) echo $bid['id']; ?>" data-bidder="<?php if(isset($bid['firstname'])) echo $bid['firstname'].' '.$bid['lastname']; ?>" data-ownerid="<?php if(isset($bid['bidder_id'])) echo $bid['bidder_id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="icon-feather-mail"></i>  <?= $this->lang->line('lang_model_send_message_title'); ?></a>
												</div>
											</div>
										</div>
									</div>
								</li>
								<!-------EnDs---->
								<?php } ?>

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

<!-----------------Common Models -------------------------------------------------------------------------------->
<?php $this->load->view('user/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>