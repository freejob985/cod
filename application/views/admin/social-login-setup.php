<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Social Login Setup | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b><?= $social_log[0]['name'] ?> LOGIN SETUP</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= site_url(); ?>"></a></li>
						<li><?= $social_log[0]['name'] ?> LOGIN SETUP</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">
				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					
          <hr>

          <div class="row"> 
          <div class="col-xl-12">
          <!--PAYMENT INFO -->
          <div class="card">
          <div class="card-body">
          <h4 class="card-title"><b> <?= $social_log[0]['name'] ?> LOGIN SETUP </b></h4>
          <hr>

          <?php if(!empty($this->session->flashdata('error'))) { ?>
          <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span><?= $this->session->flashdata('error')?></span></div>
          <?php } ?>

          <?php if(!empty($this->session->flashdata('success'))) { ?>
          <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span><?= $this->session->flashdata('success')?></span></div>
          <?php } ?>

          <form id="social_setup_form" class="forms-sample" method="post" enctype="multipart/form-data" action="<?= site_url('social/social_data_save/?id='.$social_log[0]['id']) ?>" />

          		<div class="alert alert-info">
          			<p><b>Authorized redirect URIs :</b> <?= base_url().'social/social_login?method='.$social_log[0]['name'].'&completed=yes' ?></p>
          		</div>


                <div class="form-group">
                  <label for="appid"><?= strtoupper($social_log[0]['name']); ?> APP ID</label>
                  <input type="text" class="form-control" id="appid" name ="appid" value="<?php if(isset($social_log[0]['appid'])) {echo $social_log[0]['appid']; } ?>">
                </div>

              

                <div class="form-group">
                  <label for="secretid"><?= strtoupper($social_log[0]['name']); ?> APP SECRET</label>
                  <input type="text" class="form-control" id="secretid" name ="secretid" value="<?php if(isset($social_log[0]['secretid'])) {echo $social_log[0]['secretid']; } ?>">
                </div>

             


            <button type="submit" name="btn_paypal" class="btn btn-success mr-2">Save</button>

            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

          </form>
          </div>
          </div>


            <div id="notification"></div>
            <span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
            
          </div>
                              
          </div>
          <!-- end row -->  
						
					</div>
					<!--Full Tabs Ends-->
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
<? if(DEMO_MODE) { 
  $this->load->view('admin/includes/disabled');
} ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>