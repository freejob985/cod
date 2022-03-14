<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

	<!--User Page Meta Tags-->
	<title>Refferal Control | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--User Page Meta Tags-->

	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/headerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="loadWithdrawalsDataRef();">

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
						<h3><?= $this->lang->line('lang_refferal_title') ?></h3>
						<span class="margin-top-7"><?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?> <?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?> <a href=""></a></span>

						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="#"><?= $this->lang->line('lang_user_home') ?></a></li>
								<li><a href="#">Refferal Control</a></li>
							</ul>
						</nav>
					</div>

					<div id="admin_refferals" class="col-xl-12">
						<div class="dashboard-box">

							<!-- Headline -->
							<div class="headline">
								<h3><i class="icon-material-outline-lock"></i> Referral Commissions</h3>
							</div>

							<div class="content with-padding">
								<form action="<?= base_url().'refferal/save_refferal_com'?>" method="post">
									<div class="row">
										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Listing Plan (Commission) <info>%</info></h5>
												<code>0 to disable</code>
												<input type="number" class="form-control" id="ref_plan_com" name ="ref_plan_com" value="<?php echo $settings[0]['ref_plan_com'] ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Success Sale Value (Commission) <info>%</info> </h5>
												<code>0 to disable</code>
												<input type="number" class="with-border" id="ref_sale_com" name ="ref_sale_com" value="<?php echo $settings[0]['ref_sale_com'] ?>">
											</div>
										</div>


									</div>

									<div class="row">
										<button type="submit" class="btn btn-success margin-top-30"> Save </button>
										<div id="buttonChangePassword"></div>
										<span id="loadingImageChangePassword" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
									</div>

									<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

								</form>
								
							</div>
						</div>
						
						<div class="dashboard-box margin-top-20">
							<!-- Headline -->
							<div class="headline">
								<h3><i class="mdi mdi-currency-usd"></i> USERS ELIGIBLE FOR REFERAL PAYMENTS</h3>
							</div>

							<div class="content  with-padding padding-bottom-0">
								<!--- row ------>
								<div class="row">
									<div class="col-xl-12">
										<div class="withdraw-alert alert alert-info">
											<img class="my-alert__icon" src="./images/icon-alert.svg" alt>
											<span class="my-alert__text">
												Eligable users pending for referal approvals
											</span>
										</div>

										<!-- Begin Pending card -->
										<div class="withdraw-card card">
											<div class="withdraw-card__header card-header">
												<h3 class="withdraw-card__header-title card-title">PENDING REFFERALS FOR APPROVAL</h3>
												<a class="withdraw-card__header-link" href="#"></a>
											</div>

											<?php foreach ($refferals as $reffer) { ?>
												
												<ul class="withdraw-list list-group list-group-flush">
													<!----Item ----->
													<li class="withdraw-list-item list-group-item">
														<div class="withdraw-list-item__date">
															<span class="withdraw-list-item__date-day"><?php if(isset($reffer['date'])) echo date("d", strtotime($reffer['date'])); ?></span>
															<span class="withdraw-list-item__date-month"><b><?php if(isset($reffer['date'])) echo date("M", strtotime($reffer['date'])); ?></b></span>
														</div>

														<div class="withdraw-list-item__text">
															<h4 class="withdraw-list-item__text-title"><b><?php if(isset($reffer['firstname'])) echo $reffer['firstname'] ; ?> </b></h4>
															<p class="withdraw-list-item__text-description text-success"> has purchased <?= $reffer['eligible_count']; ?> listings </p>
															<br>
															<p class="withdraw-list-item__text-description text-warning"> Reffered By <b><?= $reffer['userGroupname']?> </b> |  Waiting for affiliate payment </p>
															<br>
															<div class="input-group-prepend">
																<a href="<?= base_url().'refferal/markAsApproved?id='.$reffer['id'] ?>" class="text-success"><b>APPROVE</b></a>  &nbsp;&nbsp;|&nbsp;&nbsp;  <a href="<?= base_url().'refferal/markAsRejected?id='.$reffer['id'] ?>" class="text-danger"><b>REJECT</b></a> 
															</div>
														</div>

														<div class="withdraw-list-item__fee">
															<span class="withdraw-list-item__fee-delta">+<?= $reffer['payment_amount']; ?></span>
															<span class="withdraw-list-item__fee-currency"><?php if(!empty($currency)) echo $currency; else echo 'USD'; ?></span>
															<?php if((int) $reffer['eligible_count'] > 0) {?>
																<span class="badge badge-warning"> eligible</span>
															<?php } ?>
														</div>
														
													</li>
													<!----/Item ----->
												</ul>
											<?php } ?>
										</div>
										<!-- End Pending card -->
									</div>
								</div>
								<!---/row --->
							</div>
							<!-- Pagination -->
							<div class="clearfix"></div>
							<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
								<nav class="pagination paginationWithdrawals">
									<ul>
										<?php if(isset($links)) { echo $links; }?>
									</ul>
								</nav>
							</div>
							<div class="clearfix"></div>
							<!-- Pagination / End -->
						</div>

					</div>

					<!-- Dashboard Box -->
					<div class="col-xl-12">
						<div class="dashboard-box margin-top-0">

							<!-- Headline -->
							<div class="headline">
								<h3>WITHDRAWAL REQUESTS</h3>
							</div>

							<!----- PAGES ---------------->
							<div class="content with-padding padding-bottom-10">
								<div class="row">
									<div class="col-xl-12">

										<div class="col-xl-12">
											<div class="submit-field">
												<h5>FILTER REQUESTS</h5>
												<select class="form-control" id="filter_type_withdraw_ref" name="filter_type_withdraw_ref">
													<option value="0"> PENDINGS FOR APPROVALS </option>
													<option value="2"> PAID </option>
													<option value="3"> REJECTED </option>
												</select>
											</div>
											<span id="loaderapp" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
										</div>

										<div class="row">
											<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
												<div class="card mb-3">
													<div class="card-body">
														<div class="table-responsive">
															<table id="tbl_withdrawals_ref" class="table table-bordered table-hover display">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>USER</th>
																		<th>METHOD</th>
																		<th>AMOUNT($)</th>
																		<th>FEE($)</th>
																		<th>DATE</th>
																		<th>STATUS</th>
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


									</div>
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
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>