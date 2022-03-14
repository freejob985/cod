<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_c_create_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
				<h3><b><?= $this->lang->line('lang_c_create_title') ?> </b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_c_create_title') ?></li>
					</ul>
				</nav>
			</div>

			<!-- Row -->
			<div id="listing_type_selection" class="row">
				<div class="col-xl-12">
					<form id="listingTypeForm" name="listingTypeForm" method="POST" enctype="multipart/form-data">

					<div class="row centerButtons">

						<?php
						if(!empty($platforms)) { 
						foreach ($platforms as $platform) { ?>
						
						<div class="col-xl-4">
							<a href="<?= base_url().'user/create_listings/'.$platform['platform']; ?>" style="display: block;">
							<div class="submit-field item">

                                <!--<input id="answer_<?php echo $platform['id']; ?>" type="radio" name="branch_1_group_1" value="<?php echo $platform['platform']; ?>" class="required">-->
                                
                                <label for="answer_<?php echo $platform['id']; ?>"><img src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $platform['icon']; ?>" alt=""><strong><?= $this->lang->line($platform['platform']); ?></strong><?= $this->lang->line($platform['platform'].'_desc'); ?></label>
                                
							</div>
							</a>
							
						</div>
						
						<?php } } else { echo 'Sorry, No platforms are activated.';} ?>

					</div>
					<!--<div class="row centerButtons">
						<button type="submit" value="<?= $this->lang->line('lang_c_button_next') ?>" class="button ripple-effect big margin-top-30" style="float: right;"><?= $this->lang->line('lang_c_button_next') ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
					</div>-->

					</form>
				</div>
				
				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				
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
<!--------------------------------------------------------------------------------------------------------------->
 
</body>
</html>