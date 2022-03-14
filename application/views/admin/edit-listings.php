<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_e_edit') ?> <?= ucfirst($this->lang->line($listingType));?> <?= $this->lang->line('lang_e_listings') ?> - <?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | <?php echo $this->lang->line('site_name') ?>| <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
<?php $this->load->view('admin/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->

	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3><b><?= $this->lang->line('lang_e_edit') ?> <?= ucfirst($this->lang->line($listingType));?> <?= $this->lang->line('lang_e_listings') ?> | </b> <?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | <?php if(isset($domainData[0]['domain'])) echo $domainData[0]['domain']; ?></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_e_edit') ?> <?= ucfirst($this->lang->line($listingType));?> <?= $this->lang->line('lang_e_listings') ?></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<form id="createListingFormAdmin" name="createListingFormAdmin" method="POST" enctype="multipart/form-data">
				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> <?= $this->lang->line('lang_e_listings_title') ?></a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>LISTING OWNER</h5>
										<select class="required" id="user_id" name="user_id" class="selectpicker with-border">
											<?php foreach ($allusers as $userrow) { ?>
												<option value="<?= $userrow['user_id'] ?>" <?= $userrow['user_id'] === $listing_data[0]['user_id'] ? 'selected' : ''; ?>><?= $userrow['username'] ?></option>
											<?php } ?>
                                            
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= ucfirst($this->lang->line($listingType));?></b> <?= $this->lang->line('lang_c_name') ?></h5>
										<input type="text" id="website_BusinessName" name="website_BusinessName" value="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>" class="with-border" readonly="true" placeholder="Business Name" required>
										<input type="hidden" name="listing_id" name="listing_id" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
										<input type="hidden" name="listing_type" name="listing_type" value="<?php if(isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; ?>">
										<input type="hidden" name="listing_option" name="listing_option" value="<?php if(isset($listing_data[0]['listing_option'])) echo $listing_data[0]['listing_option']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= ucfirst($this->lang->line($listingType));?></b> <?= $this->lang->line('lang_c_age') ?> <span>(<?= $this->lang->line('lang_c_years') ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="Should be add in years"></i></h5>
										<input type="text" id="website_age" name="website_age" value="<?php if(isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?>" class="with-border" placeholder="2 Years" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= ucfirst($this->lang->line($listing_data[0]['listing_type']))?> <?= $this->lang->line('lang_c_registered')  ?></h5>
										<select class="required" id="business_registeredCountry" name="business_registeredCountry" class="selectpicker with-border">
                                            <option value="" selected><?= $this->lang->line('lang_c_registered_domain_sub')  ?></option>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= ucfirst($this->lang->line($listingType));?></b> <?= $this->lang->line('lang_c_subcribers_industry') ?></h5>
										<?php if(isset($listing_data[0]['website_industry']) && !empty($listing_data[0]['website_industry'])) ?>
                                        <select class="required" name="website_industry" id="website_industry" class="selectpicker with-border">
                                            <option value=""><?= $this->lang->line('lang_website_select_your') ?> <?= ucfirst($this->lang->line($listingType));?></option>
                                                <?php foreach ($categoriesData as $key) { 
                                                    if( !empty($listing_data[0]['website_industry'])) { if($key['c_id'] == $listing_data[0]['website_industry']) {
                                                ?>
                                            <option value="<?php echo $key['c_id']; ?>"selected><?php echo $key['c_name']; ?></option>
                                                <?php } else { ?>
                                            <option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
                                                <?php } }else { ?>
                                            <option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
                                                <?php } }?>
                                        </select>
									</div>
								</div>


								<div class="col-xl-8">
									<div class="submit-field">
										<h5><b> <?= $this->lang->line('lang_c_financial_overview') ?> : </b> <?= $this->lang->line('lang_c_revenue_expenses') ?> <span>(<?= $this->lang->line('lang_c_net_profit') ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="<?= $this->lang->line('lang_c_net_profit_title') ?>"></i></h5>
										<div class="row">
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="last12_monthsrevenue" name="last12_monthsrevenue" value="<?php if(isset($listing_data[0]['last12_monthsrevenue']) && !empty($listing_data[0]['last12_monthsrevenue'])) echo $listing_data[0]['last12_monthsrevenue']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="last12_monthsexpenses" name="last12_monthsexpenses" value="<?php if(isset($listing_data[0]['last12_monthsexpenses']) && !empty($listing_data[0]['last12_monthsexpenses'])) echo $listing_data[0]['last12_monthsexpenses']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="annual_profit" name="annual_profit" value="<?php if(isset($listing_data[0]['annual_profit']) && !empty($listing_data[0]['annual_profit'])) echo $listing_data[0]['annual_profit']; ?>" class="with-border" placeholder="" readonly="true" required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-12">
									<h5><b> <?= $this->lang->line('lang_c_financial_evidence') ?></b> <span>(<?= $this->lang->line('lang_c_optional') ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
									<div class="row">
										<div class="col-xl-6">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-visual" type="file" accept="image/*, application/pdf" id="uploadVisual" name="uploadVisual" />
												<label class="uploadButton-button ripple-effect" for="uploadVisual"><?= $this->lang->line('lang_c_upload_files') ?></label>
												<span class="uploadButton-file-name-visual"><b><?= $this->lang->line('lang_c_upload_files_1') ?></b></span>
											</div>
										</div>
										</div>

										<div class="col-xl-6">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-profit" type="file" accept="image/*, application/pdf" id="uploadProfitLoss" name="uploadProfitLoss" />
												<label class="uploadButton-button ripple-effect" for="uploadProfitLoss"><?= $this->lang->line('lang_c_upload_files') ?></label>
												<span class="uploadButton-file-name-profit"><b><?= $this->lang->line('lang_c_upload_files_2') ?></b></span>
											</div>
										</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-12">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_c_google_analytics') ?> <span>(<?= $this->lang->line('lang_c_recommend') ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="Link your site with google analytics"></i></h5>
										 		<input type="hidden" name="verifiedGA" id="verifiedGA" value="<?php if(isset($listing_data[0]['google_verified'])) echo $listing_data[0]['google_verified']; ?>">
                                        		<?php if(isset($listing_data[0]['google_verified']) && $listing_data[0]['google_verified'] ==='1') { ?>
                                        		<a href="<?php echo base_url()."analytics/unlink/".$listing_data[0]['domain_id'].'/'.$listing_data[0]['id']; ?>" role='button' class="button ripple-effect big text-center" style="width: 100%;"><?= $this->lang->line('lang_c_google_analytics_unlink') ?> </a>
                                        		<?php } else {?>
                                        		<a href="<?php echo base_url()."analytics/index/".$listing_data[0]['domain_id'].'/'.$listing_data[0]['id']; ?>" role='button' class="button ripple-effect big text-center" style="width: 100%;"> <?= $this->lang->line('lang_c_google_analytics_sub') ?></a>
                                        		<?php }?>
                                        	</div>
                                        </div>
									</div>

								</div>

							</div>
							<!---1st Row ends-->

							<div class="row">

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_tagline') ?></h5>
										<input type="text" id="website_tagline" name="website_tagline" class="required form-control" placeholder="Tag Line" value="<?php if(isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>" required>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_meta_description') ?> <?= ($this->lang->line($listingType));?></h5>
										<textarea id="website_metadescription" name="website_metadescription" rows = "5" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_business_do') ?><span>(<?= $this->lang->line('lang_c_imporatnt') ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="<?= $this->lang->line('lang_c_business_do_title') ?>"></i></h5>
										<textarea id="summernote" name="editordata" rows = "5" cols = "60" class="form-control"><?php if(isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_how_does_make_money') ?></h5>
										<textarea id="website_how_make_money" name="website_how_make_money" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_how_make_money'])) echo $listing_data[0]['website_how_make_money']; ?></textarea>
									</div>
								</div>


								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_discribe_full_fil') ?></h5>
										<textarea id="website_purchasing_fulfilment" name="website_purchasing_fulfilment" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_purchasing_fulfilment'])) echo $listing_data[0]['website_purchasing_fulfilment']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_why_Selling') ?></h5>
										<textarea id="website_whyselling" name="website_whyselling" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_whyselling'])) echo $listing_data[0]['website_whyselling']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_perfect_for') ?></h5>
										<textarea id="website_suitsfor" name="website_suitsfor" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_suitsfor'])) echo $listing_data[0]['website_suitsfor']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage" />
											<label class="uploadButton-button ripple-effect" for="uploadListingImage"><?= $this->lang->line('lang_c_upload_cover') ?></label>
											<span class="uploadButton-file-name-cover"><b><?= $this->lang->line('lang_c_upload_cover_sub') ?></b></span>
										</div>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-thumb" type="file" accept="image/*" id="uploadThumbnailImage" name="uploadThumbnailImage" />
											<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage"><?= $this->lang->line('lang_c_upload_thumb') ?></label>
											<span class="uploadButton-file-name-thumb"><b>L<?= $this->lang->line('lang_c_upload_humb_sub') ?></b></span>
										</div>
									</div>
								</div>


							</div>

							<!-- Row -->
							<?php $this->load->view('admin/includes/edit-listing-method'); ?>
							<!--/ Row -->

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->
						
							</div>

						</div> <!--/Panel Ends--->
						
					</div>
					<!--Full Tabs Ends-->
				</div>
				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				
				</form>

				<div class="col-xl-12">
					<span id="loadingImageSubmit" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                    <div id="submitValidaton"></div>
					<button type="submit" class="button ripple-effect big margin-top-30" style="float: right;" form="createListingFormAdmin"><i class="icon-feather-plus"></i>  <?= $this->lang->line('lang_e_update_changes') ?></button>
				</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
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
<script>
    $(document).ready(function() {
        $('#summernote,#summernoteDomain').summernote({
                height: 300,
                dialogsInBody: true

            });
        });
</script>

<script>
	populateListOfCountries('business_registeredCountry','<?php echo $listing_data[0]['business_registeredCountry']; ?>');
	$('.uploadButton-input-cover').next('label').text("<?php echo $listing_data[0]['website_cover']; ?>");
	$('.uploadButton-input-thumb').next('label').text("<?php echo $listing_data[0]['website_thumbnail']; ?>");
	$('.uploadButton-input-visual').next('label').text("<?php echo $listing_data[0]['financial_uploadVisual']; ?>");
	$('.uploadButton-input-profit').next('label').text("<?php echo $listing_data[0]['financial_uploadProfitLoss']; ?>");
</script>

</body>
</html>