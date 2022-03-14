<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Bulk Upload | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>Bulk Listing Upload</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Bulk Listing Upload</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<form id="upload_bulk_import" class="forms-sample" method="post" enctype="multipart/form-data"/>
						<div class="panel panel-default padding-bottom-10">

							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><span>UPLOAD LISTINGS (IMPORTANT)</span><i class="help-icon" data-tippy-placement="right" title="You must filled in template csv file"></i></a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

							<div class="alert alert-danger"><strong>IMPORTANT :</strong> Please note that we don't recommand importing items directly to database. However due to lot of customer requests we have added this feature. if you do not upload proper data your website could crash.</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5><span>BULK IMPORT TYPE</span><i class="help-icon" data-tippy-placement="right" title="Please select Import listing mode"></i></h5>
									<select id="import_type" name="import_type" class="form-control">
                                      <option value="bulk">BULK IMPORT</option>
                                    </select>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<a href="<?php echo base_url().'assets/img/samples/upload.xlsm' ?>" class="button ripple-effect big margin-top-30">DOWNLOAD TEMPLATE</a>
								</div>
							</div>

							<!---UPLOAD GOOGLE JSON KEY FILE ----->
                        	<div class="col-xl-12">
                          	<div class="submit-field">
                            	<h5>BULK LISTING UPLOAD</h5>
                            	<div class="uploadButton margin-top-30">
                              		<input class="uploadButton-input-cover" type="file" accept="/*" id="uploadExcel" name="uploadExcel" required/>
                              		<label class="uploadButton-button ripple-effect" for="uploadExcel">UPLOAD CSV FILE</label>
                              		<span class="uploadButton-file-name-cover"><b>UPLOAD CSV FILE</b></span>
                            	</div>
                          	</div>
                        	</div>

                        	<div class="col-xl-12">
								<button id="upload_bulk_import_btn" type="submit" class="button ripple-effect big margin-top-30" style="float: right;" form="upload_bulk_import"><i class="icon-feather-plus"></i> IMPORT</button>
								<div id="notificationkey"></div>
                    			<span id="loaderkey" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
							</div>

							<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                        	
                    		</div>
                			</div>
            				</div>
            				</div>
                        	
                        </div>                       
                      	</form>

						
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