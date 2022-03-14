<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_domains_listings_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
				<h3><b><?= $this->lang->line('lang_domains_listings_title') ?> </b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><a href="<?= base_url() ?>user/create_listings"><?= $this->lang->line('lang_c_create') ?> <?= $this->lang->line('lang_c_listings') ?></a></li>
						<li><?= $this->lang->line('lang_domains_listings_title') ?></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div id="create_listing_sesction" class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">

					<form id="createListingForm" name="createListingForm" method="POST" enctype="multipart/form-data">

					<!-------Sell Domains--------------------------------------------------------------------------------------------->
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<input type="hidden" id="listing_type" name="listing_type" value="<?php if(isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; else echo 'domain'; ?>">

						<!--------------------------------------------1st Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<?php if(isset($domainData[0]['domain']) && !empty($domainData[0]['domain'])) { ?>
								<div class="headline">
									<h3><a id="FirstTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> <b><?= $this->lang->line('lang_c_step_1') ?>: </b> <?= $this->lang->line('lang_domains_verify') ?></a> <span id="FirstStep" class="badge badge-success"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
								<?php } else { ?>
								<div class="headline">
									<h3><a id="FirstTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> <b><?= $this->lang->line('lang_c_step_1') ?>: </b> <?= $this->lang->line('lang_domains_verify') ?></a> <span id="FirstStep" class="badge badge-success" style="display: none;"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
								<?php }?>
							</div>

							<?php if(isset($domainData[0]['domain']) && !empty($domainData[0]['domain'])) { ?>
								<!---Listing Edit Form Tab ----->
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<?php } else { ?>
								<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<?php }?>

							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row">
										<div class="col-xl-12">
											<div class="submit-field">
											<div id="DomainValMsg"></div>
											<h5><?= $this->lang->line('lang_domains_enter_url') ?> <span>(<?= $this->lang->line('lang_c_imporatnt') ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="<?= $this->lang->line('lang_domains_verify_title') ?>"></i></h5>
											<div class="keywords-container">
												<div class="keyword-input-container">
													<input type="text" id="siteURL" name="siteURL" class="with-border" placeholder="doonlinejobs.com" required>
													<button class="keyword-input-button ripple-effect button-verify-url"><i class="fa fa-check" aria-hidden="true"></i></button>
												</div>
												<div class="clearfix"></div>
											</div>
											</div>

											<div id="domainVerificationDiv" style="display:none;" class="alert alert-dark">
                                        		<input type="hidden" name="savedDataInfo" id="savedDataInfo">
                                        		<p><b><?= $this->lang->line('lang_domains_verfy_methods') ?></b></p><br>
                                        		<span id="loadingImageVerify" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                                        		<div id="verificationFile"></div>
                                    		</div>
                                    		<div id="ContinueVal"></div>
										</div>
									</div>
								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 1st Panel -------------------------------------------------->

						<!--------------------------------------------2nd Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingTwo">
							<!-- Headline -->
								<?php if(isset($listing_data[0]['website_tagline']) && !empty($listing_data[0]['website_tagline'])) { ?>
								<div class="headline">
									<h3><a id="secondTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseTwo">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b><?= $this->lang->line('lang_c_step_2') ?>: </b> <?= $this->lang->line('lang_c_get_started') ?></a> <span id="SecondStep" class="badge badge-success"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
								<?php } else { ?>
								<div class="headline">
									<h3><a id="secondTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseTwo">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b><?= $this->lang->line('lang_c_step_2') ?>: </b> <?= $this->lang->line('lang_c_get_started') ?></a> <span id="SecondStep" class="badge badge-success" style="display: none;"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
								<?php }?>

							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">

							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_business_name') ?></h5>
										<input type="text" id="website_BusinessName" name="website_BusinessName" value="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>" class="with-border" placeholder="Business Name" readonly="true" required>
									</div>
								</div>

								<div class="col-xl-8">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_tagline') ?></h5>
										<input type="text" id="website_tagline" name="website_tagline" class="with-border" placeholder="Tag Line" value="<?php if(isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>" required>
										<input type="hidden" id="listing_id" name="listing_id" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
										<input type="hidden" id="domain_id" name="domain_id" value="<?php if(isset($listing_data[0]['domain_id'])) echo $listing_data[0]['domain_id']; ?>">
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_meta_description')  ?> <?= ucfirst($this->lang->line($listing_data[0]['listing_type']))?></h5>
										<textarea id="website_metadescription" name="website_metadescription" rows = "5" cols = "60" class="required with-border"><?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_meta_keywords')  ?><span>(<?= $this->lang->line('lang_c_imporatnt')  ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="<?= $this->lang->line('lang_c_meta_keywords_title')  ?>"></i></h5>
										<textarea id="website_metakeywords" name="website_metakeywords" rows = "3" cols = "60" class="required with-border"><?php if(isset($listing_data[0]['website_metakeywords'])) echo $listing_data[0]['website_metakeywords']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_how_old')  ?> <?= ucfirst($this->lang->line($listing_data[0]['listing_type']))?></h5>
										<input type="number" id="website_age" name="website_age" value="<?php if(isset($listing_data[0]['website_age	'])) echo $listing_data[0]['website_age	']; ?>" class="qty with-border required" placeholder="2 Years" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5> <?= ucfirst($this->lang->line($listing_data[0]['listing_type']))?> <?= $this->lang->line('lang_c_registered')  ?></h5>
										<select class="required" id="business_registeredCountry" name="business_registeredCountry" class="selectpicker with-border">
                                            <option value="" selected><?= $this->lang->line('lang_c_registered_domain_sub')  ?></option>
                                        </select>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_business_do')  ?> <span>(<?= $this->lang->line('lang_c_imporatnt')  ?>)</span>  <i class="help-icon" data-tippy-placement="right" title="<?= $this->lang->line('lang_c_business_do_title')  ?>"></i></h5>
										<textarea id="summernoteDomain" name="editordata" rows = "5" cols = "60" class="form-control required"><?php if(isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-thumb" type="file" accept="image/*, application/pdf" id="uploadThumbnailImage" name="uploadThumbnailImage"/>
											<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage"><?= $this->lang->line('lang_c_upload_thumb')  ?></label>
											<span class="uploadButton-file-name-thumb"><b><?= $this->lang->line('lang_c_upload_humb_sub')  ?></b></span>
										</div>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_c_deliver_in')  ?></h5>
										<select id="deliver_in" name="deliver_in" class="required" class="selectpicker with-border">
                        					<option value="1" selected>1 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="2" selected>2 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="3" selected>3 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="4" selected>4 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="5" selected>5 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="6" selected>6 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="7" selected>7 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="8" selected>8 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="9" selected>9 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="10" selected>10 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="11" selected>11 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="12" selected>12 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="13" selected>13 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="14" selected>14 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="15" selected>15 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="16" selected>16 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="17" selected>17 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="18" selected>18 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="19" selected>19 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="20" selected>20 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="21" selected>21 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="22" selected>22 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="23" selected>23 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="24" selected>24 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="25" selected>25 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="26" selected>26 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="27" selected>27 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="28" selected>28 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="29" selected>29 <?= $this->lang->line('lang_pricing_days') ?></option>
                        					<option value="30" selected>30 <?= $this->lang->line('lang_pricing_days') ?></option>
                       					</select>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-xl-12">
									<button type="button" id="BtnNext" name="BtnNext" value="<?= $this->lang->line('lang_c_button_next') ?>" class="button ripple-effect big margin-top-30" style="float: right;"><?= $this->lang->line('lang_c_button_next') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
								</div>
							</div>

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->
						
							</div>

						</div> <!--/ 2nd Panel Ends------------------------------------------------------------------------------->

						<!--------------------------------------------3Rd Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingThree">
							<?php if(isset($listing_data[0]['listing_option']) && !empty($listing_data[0]['listing_option'])) { ?>
								<!-- Headline -->
								<div class="headline">
									<h3><a id="ThirdTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseThree">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b><?= $this->lang->line('lang_c_step_3') ?>: </b> <?= $this->lang->line('lang_c_select_sell_method') ?> </a> <span id="ThirdStep" class="badge badge-success"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
							<?php } else { ?>
								<div class="headline">
									<h3><a id="ThirdTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseThree">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b><?= $this->lang->line('lang_c_step_3') ?>: </b> <?= $this->lang->line('lang_c_select_sell_method') ?> </a> <span id="ThirdStep" class="badge badge-success" style="display: none;"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
							<?php }?>
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row centerButtons">

										<?php if(!empty($options)) { 
										foreach ($options as $option) { ?>
										<div class="col-xl-4">
											<div class="submit-field item">
												<input id="website_1_<?php echo $option['radio']; ?>" type="radio" name="website_1_group_2" value="<?php echo $option['radio']; ?>" class="required">
                                            	<label for="website_1_<?php echo $option['radio']; ?>"><img src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $option['icon']; ?>" alt=""><strong><?= $this->lang->line($option['name']) ; ?></strong><?= $this->lang->line($option['platform'].'_desc'); ?></label>
											</div>
										</div>
										<?php } } else {echo $this->lang->line('lang_c_select_sell_options');}   ?>
										
									</div>


									<div id="Sell-Auction-Website" style="display:none;" class="row">

										<div class="col-xl-4">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_c_starting_price') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
												<input type="text" id="website_startingprice" name="website_startingprice" class="required form-control with-border" placeholder="20" value="<?php if(isset($listing_data[0]['domain_startingprice'])) echo $listing_data[0]['domain_startingprice']; ?>" onkeypress='validateInputNumbers(event)'>
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_c_reserved') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
												<input type="text" id="website_reserveprice" name="website_reserveprice" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'><small id="reservredPriceWebsite" value="<?php if(isset($listing_data[0]['domain_reserveprice'])) echo $listing_data[0]['domain_reserveprice']; ?>" class="text-danger"></small>
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_c_buy_it_now') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
												<input type="text" id="website_buynowpriceauc" name="website_buynowprice" class=" form-control with-border" placeholder="20" value="<?php if(isset($listing_data[0]['website_buynowprice'])) echo $listing_data[0]['website_buynowprice']; ?>" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
											</div>
										</div>
					
									</div>

									<div id="Sell-Classified-Website" style="display:none;" class="row">

										<div class="col-xl-4">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_c_minimum_offer') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
												<input type="text" id="website_minimumoffer" name="website_minimumoffer" class="required form-control with-border" placeholder="20" value="<?php if(isset($listing_data[0]['domain_sellingprice'])) echo $listing_data[0]['domain_sellingprice']; ?>" onkeypress='validateInputNumbers(event)'>
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_c_buy_now') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
												<input type="text" id="website_buynowpriceclas" name="website_buynowprice" class="form-control with-border" placeholder="20" value="<?php if(isset($listing_data[0]['domain_buynowprice'])) echo $listing_data[0]['domain_buynowprice']; ?>" onkeypress='validateInputNumbers(event)'><small class="text-info"> <?= $this->lang->line('lang_c_empty_disable') ?></small>
											</div>
										</div>
					
									</div>

									<div class="row">
										<div class="col-xl-12">
											<span id="loadingImageSubmit" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                                    		<div id="submitValidaton"></div>
											<button type="submit" value="<?= $this->lang->line('lang_c_button_next') ?>" class="button ripple-effect big margin-top-30" style="float: right;"><?= $this->lang->line('lang_c_button_next') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>

								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 3rd Panel -------------------------------------------------->

						<!--------------------------------------------4th Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingFour">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b><?= $this->lang->line('lang_c_step_4') ?>: </b> <?= $this->lang->line('lang_c_pay_start_selling') ?></a> <span id="FourthStep" class="badge badge-success" style="display: none;"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row centerButtons">

										<?php if(isset($listingOptions))  { 

                                		foreach ($listingOptions as $option) { ?>

										<div class="col-xl-4">
											<div class="submit-field item">
												<input id="answer_<?php echo $option['listing_id']; ?>" type="radio" name="listing_group_1" value="<?php echo $option['listing_id'] ?>" class="required">
                                            	<label for="answer_<?php echo $option['listing_id']; ?>"><img src="<?php echo base_url().ICON_UPLOAD.$option['listing_icon']; ?>" alt=""><h2><b><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($option['listing_price'])) echo $option['listing_price']; ?></b></h2><strong><?php if(isset($option['listing_name'])) echo $option['listing_name']; ?></strong><?php if(isset($option['listing_description'])) echo $option['listing_description']; ?><br><h4><b> <?= $this->lang->line('lang_c_listing_duration') ?> : <?php if(isset($option['listing_duration'])) echo $option['listing_duration']; ?> <?= $this->lang->line('lang_c_listing_days') ?> </b></h4></label>
                                            	<input type="hidden" name="txt_listamount" class="txt_listamount" value="<?php if(isset($option['listing_price'])) echo $option['listing_price']; ?>">
                                            	<input type="hidden" name="txt_listingname" class="txt_listingname" value="<?php if(isset($option['listing_name'])) echo $option['listing_name']; ?>">
											</div>
										</div>
										
										<?php } }?>

									</div>

									<div class="row">
										<div class="col-xl-12">
											<button id="BtnNextPayDom" type="button" value="<?= $this->lang->line('lang_c_button_next') ?>" class="button ripple-effect big margin-top-30" style="float: right;"><?= $this->lang->line('lang_c_button_next') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 4th Panel -------------------------------------------------->

						<!--------------------------------------------6th Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingSix">
							<!-- Headline -->
								<div class="headline">
									<h3><a id="SixthTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b><?= $this->lang->line('lang_c_step_6') ?>: </b> <?= $this->lang->line('lang_c_sponsor_listings') ?></a> <span id="SixthStep" class="badge badge-success" style="display: none;"><?= $this->lang->line('lang_c_comepleted') ?> </span></h3>
								</div>
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row centerButtons">

										<?php if(isset($sponsorOptions))  { 

                                		foreach ($sponsorOptions as $option) { ?>

										<div class="col-xl-4">
											<div class="submit-field item">
												<input id="answer_<?php echo $option['listing_id']; ?>" type="radio" name="sponsor_group_1" value="<?php echo $option['listing_id'] ?>">
                                            	<label for="answer_<?php echo $option['listing_id']; ?>"><img src="<?php echo base_url().ICON_UPLOAD.$option['listing_icon']; ?>" alt=""><h2><b><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($option['listing_price'])) echo $option['listing_price']; ?></b></h2><strong><?php if(isset($option['listing_name'])) echo $option['listing_name']; ?></strong><?php if(isset($option['listing_description'])) echo $option['listing_description']; ?><br><h4><b> <?= $this->lang->line('lang_c_listing_duration') ?> : <?php if(isset($option['listing_duration'])) echo $option['listing_duration']; ?> <?= $this->lang->line('lang_c_listing_days') ?> </b></h4></label>
											</div>
										</div>
										
										<?php } }?>

									</div>

									<div class="row">
										<div class="col-xl-12">
											<button id="BtnNextFinal" type="button" value="<?= $this->lang->line('lang_c_button_next') ?>" class="button ripple-effect big margin-top-30" style="float: right;"><?= $this->lang->line('lang_c_button_next') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 6th Panel -------------------------------------------------->
						

					</div>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					<!-----------------Sell Domains Ends------------------------------------------------------------------------------>
					</form>
				</div>

			</div>
			<!-- Row / End -->

			<!-- Row -->
			<?php $this->load->view('user/includes/user_payments'); ?>
			<!--/ Row -->
			
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
<script>checkoutlistingspage();</script>
<!--------------------------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function() {
        $('#summernote,#summernoteDomain').summernote({
                height: 300,
                dialogsInBody: true

            });
        });
</script>

<script>populateListOfCountries('business_registeredCountry');</script>
</body>
</html>