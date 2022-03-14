<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_user_settings_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3><?= $this->lang->line('lang_user_settings_title') ?></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_user_settings_title') ?></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<form id="UserDetailsChangeForm" method="post" enctype="multipart/form-data"/>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> <?= $this->lang->line('lang_user_settings_my_account') ?></h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<div class="col-auto">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<img class="profile-pic" src="<?php if(!empty($userdata[0]['thumbnail'])) echo base_url().USER_UPLOAD.$userdata[0]['thumbnail']; else echo 'images/user-avatar-placeholder.png'; ?>" alt="" />
										<div class="upload-button"></div>
										<input id="uploadthumbnail" name="uploadthumbnail" class="file-upload" type="file" accept="image/*" value="<?php if(!empty($userdata[0]['thumbnail'])) echo realpath(USER_UPLOAD.$userdata[0]['thumbnail']); ?>" />
									</div>
								</div>

								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_txt_firstname') ?></h5>
												<input id="firstname" name="firstname" type="text" class="with-border" value="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?>">
												<input id="user_id" name="user_id" type="hidden" value="<?php if(isset($userdata[0]['user_id'])) echo $userdata[0]['user_id']; ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_txt_lastname') ?></h5>
												<input id="lastname" name="lastname" type="text" class="with-border" value="<?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<!-- Account Type -->
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_txt_account_status') ?></h5>
												<div class="account-type">
													<div>
														<?php if($userdata[0]['online'] === '1') { ?>
														<input type="radio" name="account-online-radio" id="seller-radio" class="account-type-radio" value="1" checked/>
														<?php } else {?>
														<input type="radio" name="account-online-radio" id="seller-radio" class="account-type-radio" value="1" />
														<?php }  ?>
														<label for="seller-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> <?= $this->lang->line('lang_txt_account_status_on') ?></label>
													</div>

													<div>
														<?php if($userdata[0]['online'] === '0') { ?>
														<input type="radio" name="account-online-radio" id="employer-radio" class="account-type-radio" value="0" checked/>
														<?php } else {?>
														<input type="radio" name="account-online-radio" id="employer-radio" class="account-type-radio" value="0" />
														<?php }  ?>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> <?= $this->lang->line('lang_txt_account_status_of') ?></label>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5><?= $this->lang->line('lang_txt_email') ?></h5>
												<input type="email" class="with-border" value="<?php if(isset($userdata[0]['email'])) echo $userdata[0]['email']; ?>" readonly="true">
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> <?= $this->lang->line('lang_user_settings_my_profile') ?></h3>
						</div>

						<div class="content">
							<ul class="fields-ul">
							<li>
								<div class="row">
									<div class="col-xl-6">
										<div class="submit-field">
											<h5><?= $this->lang->line('lang_user_settings_meta_desc') ?></h5>
											<textarea id="user_metadescription" name="user_metadescription" cols="30" rows="2" class="with-border"><?php if(isset($userdata[0]['user_metadescription'])) echo $userdata[0]['user_metadescription']; ?></textarea>
										</div>
									</div>

									<div class="col-xl-6">
										<div class="submit-field">
											<h5><?= $this->lang->line('lang_user_settings_nationality') ?></h5>
											<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected><?= $this->lang->line('lang_user_settings_nationality_what') ?></option>
                                        	</select>
										</div>
									</div>

									<div class="col-xl-12">
										<div class="submit-field">
											<h5><?= $this->lang->line('lang_user_settings_into') ?></h5>
											<textarea id="user_description" name="user_description" cols="30" rows="5" class="with-border"><?php if(isset($userdata[0]['user_description'])) echo $userdata[0]['user_description']; ?></textarea>
										</div>
									</div>

								</div>
							</li>
						</ul>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> <?= $this->lang->line('lang_user_settings_social') ?></h3>
						</div>

						<div class="content with-padding">
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_social_Twitter') ?></h5>
										<input id="social_twitter" name="social_twitter" type="text" class="with-border" value="<?php if(isset($userdata[0]['social_twitter'])) echo $userdata[0]['social_twitter']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_social_facebook') ?></h5>
										<input id="social_facebook" name="social_facebook" type="text" class="with-border" value="<?php if(isset($userdata[0]['social_facebook'])) echo $userdata[0]['social_facebook']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_social_youtube') ?></h5>
										<input id="social_youtube" name="social_youtube" type="text" value="<?php if(isset($userdata[0]['social_youtube'])) echo $userdata[0]['social_youtube']; ?>" class="with-border">
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>


				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> <?= $this->lang->line('lang_payment_settings') ?></h3>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_payment_paypal_email') ?></h5>
										<input id="paypal_email" name="paypal_email" type="text" class="with-border" value="<?php if(isset($userdata[0]['paypal'])) echo $userdata[0]['paypal']; ?>">
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_payment_payoneer_email') ?></h5>
										<input id="payoneer_email" name="payoneer_email" type="text" class="with-border" value="<?php if(isset($userdata[0]['payoneer'])) echo $userdata[0]['payoneer']; ?>">
									</div>
								</div>
								<?php } else if ($key['id'] === '3') { ?>
								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_payment_bank_account') ?></h5>
										<input id="bank_accountname" name="bank_accountname" type="text" class="with-border" value="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?> <?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?>"  readonly=true>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_payment_bank_account_details_1') ?><code> <?= $this->lang->line('lang_payment_bank_account_details_2') ?></code></h5>
										<textarea rows="8" id="bank_details" name="bank_details" type="text" class="with-border"><?php if(isset($userdata[0]['bank_transfer'])) echo $userdata[0]['bank_transfer']; ?> </textarea> 
									</div>
								</div>
								<?php } } ?>

								<?php if (in_array('ESCROW',array_column($paymentsOptions,'method'))) { ?>
								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_payment_escrow_email') ?></h5>
										<input id="escrow_email" name="escrow_email" type="email" class="with-border" value="<?php if(isset($userdata[0]['escrow_email'])) echo $userdata[0]['escrow_email']; ?>" required>
									</div>
								</div>
								<?php } ?>

							</div>
						</div>
					</div>
				</div>
				
				<!-- Button -->
				<div class="col-xl-12">
					<button type="submit" class="btn btn-success margin-top-30"><?= $this->lang->line('lang_user_settings_save') ?></button>
                   	<div id="validator"></div>
                   	<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
				</div>

				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

			</form>

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

<?php if(isset($userdata[0]['user_country']) && !empty($userdata[0]['user_country'])) {?>
	<script>populateListOfCountries('user_country','<?php echo $userdata[0]['user_country']; ?>');</script>
<?php }else {?>
	<script>populateListOfCountries('user_country');</script>
<?php } ?>

</body>
</html>