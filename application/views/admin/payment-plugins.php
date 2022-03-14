<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Payment Plugins  | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Payments Plugins Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Payments Plugins Manager</a></li>
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
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <form id="plugin_upload_form" class="forms-sample" method="post" enctype="multipart/form-data"/>
                      <div class="form-group">
                        <div id="pluginUploadmsg"></div>
                        <label><b>UPLOAD A NEW PLUGIN</b></label>
                        <hr>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="file" name="fileToUpload" id="fileToUpload" class="form-control file-upload-info" placeholder="Upload Plugin">
                          <span class="input-group-append">
                            <button name="btn_pluginupload" class="btn btn-info" type="submit"><i title="upload" class="fas fa-cloud-upload-alt"></i></button>
                            <span id="loadingImagePlugins" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                          </span>
                        </div>
                      </div>                        
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br><br>

          <div class="col-12 grid-margin">
           <div class="card">
            <div class="card-body">
             <h4 class="card-title"><b>INSTALLED PAYMENT PLUGINS</b></h4>
             <hr>
             <form class="forms-sample">
              <!--/Plugins Table -->
              <div id="table_payments_div" class="table-responsive">
               <table id="table_payments" class="table table-striped table-hover responsive">
                 <tbody>
                   <?php if(isset($payments)) { foreach ($payments as $plugin) { ?>
                    <tr>

                      <td>
                        <img class="img_upload_payment" src="<?= $plugin['icon_url']; ?>">
                      </td>

                      <td>
                        <b><?php if(isset($plugin['method'])) {echo $plugin['method']; } ?></b>
                      </td>

                      <td>
                        <?php if($plugin['status']) { ?>
                          <span class="badge badge-success">ACTIVE</span>
                        <?php } else { ?>
                          <span class="badge badge-warning">INACTIVE</span>
                        <?php }?>
                      </td>

                      <td>
                        <a href="<?= base_url('admin/payments_setup?pid='.$plugin['id']); ?>">SETUP</a>
                      </td>

                      <td>
                        <?php if(!$plugin['is_fixed']) { ?>
                          <button type="button" class="btn btn-danger payment_remove" data-id=<?php if(isset($plugin['id'])) {echo $plugin['id']; } ?> ><i class="fa fa-times"></i></button>
                        <?php } ?>
                      </td>

                    </tr>
                  <?php } } else {echo "No payment plugins are installed.."; } ?>

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