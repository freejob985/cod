<!DOCTYPE html>
<html lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title>Create Websites |<?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>Create a Website Listing </b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Create Websites</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<form id="createDomainsForm" name="createDomainsForm" method="POST" enctype="multipart/form-data">
				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Create Websites Form</a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-8">
									<div class="submit-field">
										<div class="keywords-container">
											<h5>Enter your URL <span>(Important)</span>  <i class="help-icon" data-tippy-placement="right" title="Please enter a URL and verify"></i></h5>
											<div class="keyword-input-container">
												<input type="text" id="adminsiteURL" name="adminsiteURL" class="with-border" placeholder="http://doonlinejobs.com" required>
											</div>
											<div class="clearfix"></div>
										</div>
										<input type="hidden" name="listing_id" name="listing_id" value="">
										<input type="hidden" name="listing_type" name="listing_type" value="website">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Business Age <span>(Years)</span>  <i class="help-icon" data-tippy-placement="right" title="Should be add in years"></i></h5>
										<input type="number" id="website_age" name="website_age" value="" class="with-border" placeholder="2 Years" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Business Registered</h5>
										<select class="required" id="business_registeredCountry" name="business_registeredCountry" class="selectpicker with-border">
                                            <option value="" selected>Where is your business registered?</option>
                                        </select>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Website Category</h5>
										<?php if(isset($listing_data[0]['website_industry']) && !empty($listing_data[0]['website_industry'])) ?>
                                        <select class="required" name="website_industry" id="website_industry" class="selectpicker with-border">
                                            <option value="">Select Your Website Industry</option>
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

								<div class="col-xl-12">
									<div class="submit-field">
										<h5><b> Financial Overview : </b> Revenue | Expenses | <span>(Net Profit)</span>  <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
										<div class="row">
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="last12_monthsrevenue" name="last12_monthsrevenue" value="<?php if(isset($listing_data[0]['last12_monthsrevenue'])) echo $listing_data[0]['last12_monthsrevenue']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="last12_monthsexpenses" name="last12_monthsexpenses" value="<?php if(isset($listing_data[0]['last12_monthsexpenses'])) echo $listing_data[0]['last12_monthsexpenses']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="annual_profit" name="annual_profit" value="<?php if(isset($listing_data[0]['annual_profit'])) echo $listing_data[0]['annual_profit']; ?>" class="with-border" placeholder="" readonly="true" required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-12">
									<h5><b> Financial Evidences </b> <span>(Optional)</span>  <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
									<div class="row">
										<div class="col-xl-6">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-visual" type="file" accept="image/*, application/pdf" id="uploadVisual" name="uploadVisual" />
												<label class="uploadButton-button ripple-effect" for="uploadVisual">Upload Files</label>
												<span class="uploadButton-file-name-visual"><b>Visual Evidence of Revenue Screenshot or video walkthrough. Can be from Quickbooks, AdSense, Shopify, Amazon, PayPal, etc.</b></span>
											</div>
										</div>
										</div>

										<div class="col-xl-6">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-profit" type="file" accept="image/*, application/pdf" id="uploadProfitLoss" name="uploadProfitLoss" />
												<label class="uploadButton-button ripple-effect" for="uploadProfitLoss">Upload Files</label>
												<span class="uploadButton-file-name-profit"><b>P&L (Profit and Loss Statement), Please ensure this is up to date to gain customer trust towards your listings.Ignore if you don't have this</b></span>
											</div>
										</div>
										</div>
									
									</div>

								</div>

							</div>
							<!---1st Row ends-->

							<div class="row">

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Tagline</h5>
										<input type="text" id="website_tagline" name="website_tagline" class="with-border" placeholder="Tag Line" value="<?php if(isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>" required>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Meta Description of the website</h5>
										<textarea id="website_metadescription" name="website_metadescription" rows = "5" cols = "60" class="required with-border"><?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Meta Keywords<span>(important)</span>  <i class="help-icon" data-tippy-placement="right" title="Seperate each word by a ,"></i></h5>
										<textarea id="website_metakeywords" name="website_metakeywords" rows = "3" cols = "60" class="required with-border"><?php if(isset($listing_data[0]['website_metakeywords'])) echo $listing_data[0]['website_metakeywords']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Tell us about your business so potential buyers get excited. What does your business do?<span>(Important)</span>  <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
										<textarea id="summernote" name="editordata" rows = "5" cols = "60" class="form-control"><?php if(isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>How does your business make money?</h5>
										<textarea id="website_how_make_money" name="website_how_make_money" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_how_make_money'])) echo $listing_data[0]['website_how_make_money']; ?></textarea>
									</div>
								</div>


								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Describe your purchasing and order fulfilment process</h5>
										<textarea id="website_purchasing_fulfilment" name="website_purchasing_fulfilment" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_purchasing_fulfilment'])) echo $listing_data[0]['website_purchasing_fulfilment']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Why are you selling this business?</h5>
										<textarea id="website_whyselling" name="website_whyselling" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_whyselling'])) echo $listing_data[0]['website_whyselling']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Who would this business be perfect for?</h5>
										<textarea id="website_suitsfor" name="website_suitsfor" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_suitsfor'])) echo $listing_data[0]['website_suitsfor']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Facebook</h5>
										<input type="text" id="website_facebook" name="website_facebook" value="<?php if(isset($listing_data[0]['website_facebook'])) echo $listing_data[0]['website_facebook']; ?>" class="qty form-control required" placeholder="No of Likes" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Twitter</h5>
										<input type="text" id="website_twitter" name="website_twitter" value="<?php if(isset($listing_data[0]['website_twitter'])) echo $listing_data[0]['website_twitter']; ?>" class="qty form-control required" placeholder="No of followers" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Instagram</h5>
										<input type="text" id="website_instagram" name="website_instagram" value="<?php if(isset($listing_data[0]['website_instagram'])) echo $listing_data[0]['website_instagram']; ?>" class="qty form-control required" placeholder="No of followers" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Will deliver in No of Days</h5>
										<select id="deliver_in" name="deliver_in" class="required" class="selectpicker with-border">
                        					<option value="1" selected>1 day</option>
                        					<option value="2" selected>2 days</option>
                        					<option value="3" selected>3 days</option>
                        					<option value="4" selected>4 days</option>
                        					<option value="5" selected>5 days</option>
                        					<option value="6" selected>6 days</option>
                        					<option value="7" selected>7 days</option>
                        					<option value="8" selected>8 days</option>
                        					<option value="9" selected>9 days</option>
                        					<option value="10" selected>10 days</option>
                        					<option value="11" selected>11 days</option>
                        					<option value="12" selected>12 days</option>
                        					<option value="13" selected>13 days</option>
                        					<option value="14" selected>14 days</option>
                        					<option value="15" selected>15 days</option>
                        					<option value="16" selected>16 days</option>
                        					<option value="17" selected>17 days</option>
                        					<option value="18" selected>18 days</option>
                        					<option value="19" selected>19 days</option>
                        					<option value="20" selected>20 days</option>
                        					<option value="21" selected>21 days</option>
                        					<option value="22" selected>22 days</option>
                        					<option value="23" selected>23 days</option>
                        					<option value="24" selected>24 days</option>
                        					<option value="25" selected>25 days</option>
                        					<option value="26" selected>26 days</option>
                        					<option value="27" selected>27 days</option>
                        					<option value="28" selected>28 days</option>
                        					<option value="29" selected>29 days</option>
                        					<option value="30" selected>30 days</option>
                       					</select>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-cover" type="file" accept="image/*, application/pdf" id="uploadListingImage" name="uploadListingImage" required/>
											<label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Cover Image</label>
											<span class="uploadButton-file-name-cover"><b>Listing ImageAn eye-catching image goes a long way.Upload a photograph of your site, product, or service (min 550px x 300px)</b></span>
										</div>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-thumb" type="file" accept="image/*, application/pdf" id="uploadThumbnailImage" name="uploadThumbnailImage" required/>
											<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage">Upload Image</label>
											<span class="uploadButton-file-name-thumb"><b>Listing Thumbnail Image ,An eye-catching image goes a long way.Upload a photograph of your site, product, or service (min 200px x 200px)</b></span>
										</div>
									</div>
								</div>

							</div>

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Domain Pricing Info</a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row centerButtons">
								<?php if(!empty($options)) { 
									foreach ($options as $option) { ?>
									<div class="col-xl-4">
										<div class="submit-field item">
											<input id="website_1_<?php echo $option['radio']; ?>" type="radio" name="website_1_group_2" value="<?php echo $option['radio']; ?>" class="required">
                                            <label for="website_1_<?php echo $option['radio']; ?>"><img src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $option['icon']; ?>" alt=""><strong><?php echo $option['name']; ?></strong><?php echo $option['description']; ?></label>
										</div>
									</div>
								<?php } } else {echo 'Sorry, No selling options are activated.';}   ?>
							</div>

							<div id="Sell-Auction-Website" style="display:none;" class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Starting Price (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
										<input type="text" id="website_startingprice" name="website_startingprice" class="required form-control with-border" placeholder="20" value="" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Reserve (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
										<input type="text" id="website_reserveprice" name="website_reserveprice" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'><small id="reservredPriceWebsite" value="" class="text-danger"></small>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Buy It Now (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
										<input type="text" id="website_buynowpriceauc" name="website_buynowprice" class=" form-control with-border" placeholder="20" value="" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
									</div>
								</div>
					
							</div>

							<div id="Sell-Classified-Website" style="display:none;" class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Minimum Offer (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
										<input type="text" id="website_minimumoffer" name="website_minimumoffer" class="required form-control with-border" placeholder="20" value="" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Buy Now Price (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
										<input type="text" id="website_buynowpriceclas" name="website_buynowprice" class="form-control with-border" placeholder="20" value="" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
									</div>
								</div>
					
							</div>

							

							</div>

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->

							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Listing Duration & Sponsored Duration</a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
								<div class="row">
									<div class="col-xl-4">
										<div class="submit-field">
										<h5>Activate listing for</span>  <i class="help-icon" data-tippy-placement="right" title="No of Days to Display Listing"></i></h5>
										<input type="number" min="1" id="activate_days" name="activate_days" value="1" class="with-border" placeholder="2 Days" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Sponsor Listing for</span>  <i class="help-icon" data-tippy-placement="right" title="No of Days to Sponsor"></i></h5>
										<input type="number" min="0" id="sponsor_days" name="sponsor_days" value="0" class="with-border" placeholder="2 Days" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>
								</div>
							</div>

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->

						</div> <!--/Panel Ends--->
						
					</div>
					<!--Full Tabs Ends-->
				</div>

				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				
				</form>

				<div class="col-xl-12">
					<span id="loader" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                    <div id="notification"></div>
					<button type="submit" class="button ripple-effect big margin-top-30" style="float: right;" form="createDomainsForm"><i class="icon-feather-plus"></i> Save Changes</button>
				</div>

			</div>
			<!-- Row / End -->
			<br><br>

			<div class="row">
                <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbl_domain_listings" class="table table-bordered table-hover display">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                          			<th>NAME</th>
                          			<th>Google Analytics</th>
                          			<th></th>
                                  </tr>
                                </thead>
                            </table>
                        </div>
                   	</div>              
                </div><!-- end card-->          
                </div>
            </div>

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
<? if(DEMO_MODE) { 
	$this->load->view('admin/includes/disabled');
} ?>
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
	populateListOfCountries('business_registeredCountry');
	loadDomainListingsData('9','website');
</script>


</body>
</html>