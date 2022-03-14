<!DOCTYPE html>
<html lang="en">
<head>

	<!--Admin Page Meta Tags-->
	<title>User Control | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--/Admin Page Meta Tags-->

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
						<h3>User Controls</h3>

						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">User Controls</a></li>
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
									<h3>Add / Edit Users</h3>
								</div>

								<div id="registrationStatus"></div>

								<!----- Content --->
								<div class="card">
									<div class="card-body">
										<form id="UserRegistrationFormAdmin" method="post" enctype="multipart/form-data"/>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="username_name">First Name</label>
												<input type="text" class="with-border" id="register_firstname" name = "register_firstname" placeholder="First Name" required="true">
												<input type="hidden" class="form-control" id="user_id" name = "user_id">
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="username_name">Last Name</label>
												<input type="text" class="with-border" id="register_lastname" name = "register_lastname" placeholder="Last Name" required="true">
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="username_name">Username</label>
												<div class="input-group">
													<input type="text" id="register_username" name="register_username" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?>" required>
													<div class="input-group-append">
														<span class="input-group-text">
															<i id="i_usernamecheck" class="fas fa-check-circle"></i>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="category_name">Email</label>
												<div class="input-group">
													<input type="text" id="register_email" name="register_email" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_email'); ?>" required>
													<div class="input-group-append">
														<span class="input-group-text">
															<i id="i_emailcheck" class="fas fa-check-circle"></i>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="category_meta_description">Password</label>
												<div class="input-group">
													<input type="password" id="register_password" name="register_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' : ''); if(this.checkValidity()) form.confirmPassword.pattern = this.value;" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required data-toggle="popover" title="Password Strength" data-content="Enter Password..." placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>" required>
													<div class="input-group-append">
														<span class="input-group-text">
															<i id="i_passwordcheck" class="fas fa-check-circle"></i>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="category_meta_description">Retype Password</label>
												<div class="input-group">
													<input type="password" id="register_repassword" name="register_repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_retypepassword'); ?>" required>
													<div class="input-group-append">
														<span class="input-group-text">
															<i id="i_retypepasswordcheck" class="fas fa-check-circle"></i>
														</span>
													</div>
												</div>
											</div>
										</div>


										<div class="col-xl-12">
											<div class="submit-field">
												<label for="user_status">User Status</label>
												<select class="form-control" id="user_status" name="user_status">
													<option value="1">INACTIVE</option>
													<option value="2">ACTIVE</option>
												</select>
											</div>
										</div>


										<button type="submit" name="btn_categorysave" class="btn btn-success mr-2">Save</button>
										<span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

									</form>

								</div>
							</div>



						</div>
					</div>
				</div>

				<!-- Row -->
				<div class="row">

					<!-- Dashboard Box -->
					<div class="col-xl-12">
						<div class="dashboard-box margin-top-0">

							<!-- Headline -->
							<div class="headline">
								<h3>User Controls</h3>
							</div>

							<!----- PAGES ---------------->
							<div class="row">
								<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
									<div class="card mb-3">
										<div class="card-body">
											<div class="table-responsive">
												<table id="tbl_userdata" class="table table-bordered table-hover display">
													<thead>
														<tr>
															<th>ID</th>
															<th>USERNAME</th>
															<th>EMAIL</th>
															<th>FIRST NAME</th>
															<th>IP</th>
															<th>STATUS</th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
														</tr>
													</thead>
												</table>
											</div>
										</div>              
									</div><!-- end card-->          
								</div>
							</div>
							<!----- /PAGES ---------------->
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
<? if(DEMO_MODE) { 
	$this->load->view('admin/includes/disabled');
} ?>
<script>loadUserData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>