<!DOCTYPE html>
<html lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title>Escrow Transactions | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
<?php $this->load->view('admin/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Escrow Transactions</h3>
				<span class="margin-top-7"><?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?> <?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?> <a href=""></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Escrow Transactions</li>
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
							<h3><i class="mdi mdi-currency-usd"></i>Slippa Escrow Transactions Summary</h3>
						</div>

						<div class="content  with-padding padding-bottom-10">
							<!--- row ------>
							<div class="row">
								<div class="col-xl-12">
									<div class="fun-facts-container">

										<div class="fun-fact" data-fun-fact-color="#36bd78">
											<div class="fun-fact-text">
												<span>Total Earnings</span>
												<h4><?php if(!empty($TE)) echo number_format(floatval($TE),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-currency-usd"></i></a>
										</div>

										<div class="fun-fact" data-fun-fact-color="#9bcd78">
											<div class="fun-fact-text">
												<span>Pending Escrow</span>
												<h4><?php if(!empty($PE)) echo number_format(floatval($PE),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-av-timer"></i></a>
										</div>

										<div class="fun-fact" data-fun-fact-color="#b81b7f">
											<div class="fun-fact-text">
												<span>Cleared Commisions</span>
												<h4><?php if(!empty($CE)) echo number_format(floatval($CE),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-bank"></i></a>
										</div>

									</div>
								</div>
							</div>
							<!--- /row ------>
						</div>
					</div>
				</div>
				<!-- Dashboard Box -->


				<div id="user_withdrawals" class="col-xl-12">
					<div class="dashboard-box margin-top-20">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="mdi mdi-currency-usd"></i> Escrow Transactions</h3>
						</div>

						<div class="content  with-padding padding-bottom-0">
							<!--- row ------>
							<div class="row">
								<div class="col-xl-12">
              						<div class="withdraw-alert alert alert-info">
                						<img class="my-alert__icon" src="./images/icon-alert.svg" alt>
                						<span class="my-alert__text">
                  							Please note that these transactions will be loaded directly from Escrow
                						</span>
              						</div>

              					<span id="loader" style="display:none;" class="text-center centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
              					<!-- Begin Pending card -->
              					<div id="transactions-div" class="withdraw-card card"></div>
              					<!-- End Pending card -->
            					</div>
							</div>
							<!---/row --->
						</div>
						<!-- Pagination -->
						<div class="clearfix"></div>
						<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
							<nav class="pagination paginationEscrow">
							</nav>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination / End -->
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
<script>loadEscrowTransaction(1);</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>