<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Payment Setup | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b><?= $payments[0]['method']; ?> SETUP</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= site_url('admin/payments_plugins'); ?>">Plugins</a></li>
						<li><?= $payments[0]['method']; ?></li>
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
          <h4 class="card-title"><b><?= $payments[0]['method']; ?> SETUP </b></h4>
          <hr>

          <?php if(!empty($this->session->flashdata('error'))) { ?>
          <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span><?= $this->session->flashdata('error')?></span></div>
          <?php } ?>

          <?php if(!empty($this->session->flashdata('success'))) { ?>
          <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span><?= $this->session->flashdata('success')?></span></div>
          <?php } ?>

          <form id="pgateway_setup_form" class="forms-sample" method="post" enctype="multipart/form-data" action="<?= site_url('admin/paypal_data_Save/'.$payments[0]['id']) ?>" />

            <?php if (!empty($payments[0]['fields'])) { ?>

              <div class="form-group">
                <label for="txt_user_mexpdate"><?= $payments[0]['method']; ?> STATUS : </label>
                <div id="defaultPaypalStatus">
                  <?php if($payments[0]['status']){ ?>
                    <label class='form-control badge badge-success'> ACTIVE </label>
                  <?php } else { ?>
                    <label class='form-control badge badge-danger'> INACTIVE </label>
                  <?php } ?>
                </div>
                <div id="paypalInactivity"></div>
              </div>
 

            <?php foreach (json_decode($payments[0]['fields'], true) as $key => $value) { 

              if($key === 'status') { ?>
                <div class="form-group">
                  <label for="enable_paypal">ACTIVATE <?= $payments[0]['method']; ?></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-flag"></i></span>
                    </div>
                    <select class="form-control form-control-lg" id="paypal_status" name="paypal_status">
                      <?php if($payments[0]['status']) {?>
                        <option selected="true" value="1">Yes</option>
                        <option value="0">No</option>
                      <?php } else{?>
                        <option value="1">Yes</option>
                        <option selected="true" value="0">No</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              <?php } else if($key === 'username') { ?>

                <div class="form-group">
                  <label for="paypal_username"><?= strtoupper($value); ?></label>
                  <input type="text" class="form-control" id="paypal_username" name ="paypal_username" value="<?php if(isset($payments[0]['username'])) {echo $payments[0]['username']; } ?>">
                </div>

              <?php } else if($key === 'password') { ?>

                <div class="form-group">
                  <label for="paypal_password"><?= strtoupper($value); ?></label>
                  <input type="password" class="form-control" id="paypal_password" name ="paypal_password" value="<?php if(isset($payments[0]['password'])) {echo $payments[0]['password']; } ?>">
                </div>

              <?php } else if($key === 'signature') { ?>

                <div class="form-group">
                  <label for="paypal_signature"><?= strtoupper($value); ?></label>
                  <input type="paypal_signature" class="form-control" id="paypal_signature" name ="paypal_signature" value="<?php if(isset($payments[0]['signature'])) {echo $payments[0]['signature']; } ?>">
                </div>

              <?php } else if($key === 'icon') { ?>

                <div class="form-group">
                  <label for="paypal_signature"><?= strtoupper($value); ?> <code> (This has to be an icon URL)</code></label>
                  <input type="text" class="form-control" id="icon_url" name ="icon_url" value="<?php if(isset($payments[0]['icon_url'])) {echo $payments[0]['icon_url']; } ?>">
                </div>

              <?php } else if($key === 'sandbox') { ?>

                <div class="form-group">
                  <label for="paypal_sandbox"><?= strtoupper($value); ?></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                    </div>

                    <select class="form-control form-control-lg" id="paypal_sandbox" name="paypal_sandbox">
                      <?php if($payments[0]['sandbox']) {?>
                        <option selected="true" value="1">Enable</option>
                        <option value="0">Disable</option>
                      <?php } else{?>
                        <option value="1">Enable</option>
                        <option selected="true"  value="0">Disable</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

              <?php }?>

          <?php } }?>


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