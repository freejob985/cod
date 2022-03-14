<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Social Login Plugins  | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Social Logins Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Social Logins Manager</a></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

            <br>

          <div class="col-12 grid-margin">
           <div class="card">
            <div class="card-body">
             <h4 class="card-title"><b>INSTALLED SOCIAL LOGIN PLUGINS</b></h4>
             <hr>
             <form class="forms-sample">
              <!--/Plugins Table -->
              <div id="table_payments_div" class="table-responsive">
               <table id="table_payments" class="table table-striped table-hover responsive">
                 <tbody>
                   <?php if(isset($social_log)) { foreach ($social_log as $plugin) { ?>
                    <tr>

                      <td>
                        <img class="img_upload_payment" src="<?= $plugin['icon']; ?>">
                      </td>

                      <td>
                        <b><?php if(isset($plugin['name'])) {echo $plugin['name']; } ?></b>
                      </td>

                      <td>
                        <a href="<?= base_url('social/load_social_login_setup?id='.$plugin['id']); ?>">SETUP</a>
                      </td>

                    </tr>
                  <?php } } else {echo "No Social Login plugins are installed.."; } ?>

                </tbody>
              </table>
            </div>
            <!---/Plugins Table -->
          </form>
        </div>
      </div>
    </div>
          <br>

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