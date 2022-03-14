<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Customizations | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Ads Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Customizations</a></li>
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
							<h3>Customizations</h3>
						</div>

						<!----- Content --->
						<form id="CustomizationsForm" method="post" enctype="multipart/form-data"/>
						<div class="content with-padding padding-bottom-10">
						<div class="row">

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Custom Styles <code> (make sure you enter css code within the textarea, These codes will be directly injected to your website)</code></h5>
									<small>No need to mention < style> </ style> tags </small>
									<textarea rows = "10" class="form-control" cols = "60" name = "custom_css" id="custom_css"><?php if(!empty($settings[0]['custom_css'])) echo $settings[0]['custom_css']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Custom javascript<code> (make sure you enter js code within the textarea,These codes will be directly injected to your website)</code></h5>
									<small>No need to mention < script> </ script> tags </small>
									<textarea rows = "10" class="form-control" cols = "60" name = "custom_js" id="custom_js"><?php if(!empty($settings[0]['custom_js'])) echo $settings[0]['custom_js']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-12">
								<button type="submit" name="btn_adssave" class="btn btn-success mr-2">Save</button>
                        		<div id="notification"></div>
                        		<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        	</div>

						
                        	<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</div>
						</div>
						</form>
						<!----- /Content --->

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
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>