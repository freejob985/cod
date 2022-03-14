<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_withdrawal_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
				<h3><?= $this->lang->line('lang_withdrawal_title') ?></h3>
				<span class="margin-top-7"><?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?> <?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?> <a href=""></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><a href="#"><?= $this->lang->line('lang_userdashbaord_title') ?></a></li>
						<li><?= $this->lang->line('lang_withdrawal_title') ?></li>
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
							<h3><i class="mdi mdi-currency-usd"></i> <?= $this->lang->line('lang_withdrawal_my_earnings') ?></h3>
						</div>

						<div class="content  with-padding padding-bottom-10">
							<!--- row ------>
							<div class="row">
								<div class="col-xl-12">
									<div class="fun-facts-container">

										<div class="fun-fact" data-fun-fact-color="#36bd78">
											<div class="fun-fact-text">
												<span><?= $this->lang->line('lang_withdrawal_total_earnings') ?></span>
												<h4><?php if(!empty($TE)) echo number_format(floatval($TE),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-currency-usd"></i></a>
										</div>

										<div class="fun-fact" data-fun-fact-color="#9bcd78">
											<div class="fun-fact-text">
												<span><?= $this->lang->line('lang_withdrawal_pending') ?></span>
												<h4><?php if(!empty($PE)) echo number_format(floatval($PE),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-av-timer"></i></a>
										</div>

										<div class="fun-fact" data-fun-fact-color="#b81b7f">
											<div class="fun-fact-text">
												<span><?= $this->lang->line('lang_withdrawal_withdran') ?></span>
												<h4><?php if(!empty($FC)) echo number_format(floatval($FC),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-bank"></i></a>
										</div>

										<div class="fun-fact" data-fun-fact-color="#b81b7f">
											<div class="fun-fact-text">
												<span><?= $this->lang->line('lang_withdrawal_ava_withdraw') ?></span>
												<h4 class="my-text-headline"> <?php if(!empty($AW)) echo number_format(floatval($AW),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-cash-usd"></i></a>
										</div>

									</div>
								</div>
							</div>
							<!--- /row ------>
						</div>
					</div>
				</div>
				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-20">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="mdi mdi-currency-usd"></i> <?= $this->lang->line('lang_withdrawal_withdraw_funds') ?></h3>
						</div>
						<form id="withdrawForm" name="withdrawForm" method="post" enctype="multipart/form-data"/>
						<div class="content  with-padding padding-bottom-0">
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_withdrawal_withdraw_amount') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
										<input id="withdraw_amount" name="withdraw_amount" type="number" class="with-border" value="" placeholder="50">
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_withdrawal_withdraw_method') ?></h5>
										<select id="withdrawal_method" name="withdrawal_method" class="form-control">
											<?php foreach ($withdraw_meths as $method) { ?>
                                            	<option value="<?php echo $method['id']; ?>"><?php echo $method['method'] . '(Minimum Withdrawal '.$default_currency.$method['threshold'].')'; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="m_threshold" id="m_threshold" value="">
									</div>
								</div>

								<div class="col-xl-12" style="padding-bottom: 30px;">
									<button type="submit" class="btn btn-success margin-top-30"><?= $this->lang->line('lang_withdrawal_withdraw_btn') ?></button>
                   					<div id="validator"></div>
                   					<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
								</div>
							</div>
							<!--- /row ------>
						</div>
						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						</form>
					</div>
				</div>

				<div id="user_withdrawals" class="col-xl-12">
					<div class="dashboard-box margin-top-20">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="mdi mdi-currency-usd"></i> <?= $this->lang->line('lang_withdrawal_history') ?></h3>
						</div>

						<div class="content  with-padding padding-bottom-0">
							<!--- row ------>
							<div class="row">
								<div class="col-xl-12">
              						<div class="withdraw-alert alert alert-info">
                						<img class="my-alert__icon" src="./images/icon-alert.svg" alt>
                						<span class="my-alert__text">
                  							<?= $this->lang->line('lang_withdrawal_history_sub') ?>
                						</span>
              						</div>

              					<!-- Begin Pending card -->
              					<div class="withdraw-card card">
                					<div class="withdraw-card__header card-header">
                  						<h3 class="withdraw-card__header-title card-title"><?= $this->lang->line('lang_withdrawal_history_current') ?></h3>
                  							<a class="withdraw-card__header-link" href="#"><?= $this->lang->line('lang_withdrawal_history_seeall') ?></a>
                					</div>

                					<?php foreach ($withdrawals as $withdrawal) { ?>
   
                					<ul class="withdraw-list list-group list-group-flush">
                						<!----Item ----->
                  						<li class="withdraw-list-item list-group-item">
                    						<div class="withdraw-list-item__date">
                      							<span class="withdraw-list-item__date-day"><?php if(isset($withdrawal['updated'])) echo date("d", strtotime($withdrawal['updated'])); ?></span>
                      							<span class="withdraw-list-item__date-month"><b><?php if(isset($withdrawal['updated'])) echo date("M", strtotime($withdrawal['updated'])); ?></b></span>
                    						</div>

                    						<div class="withdraw-list-item__text">
                      							<h4 class="withdraw-list-item__text-title"><b>#<?php if(isset($withdrawal['withdrawal_id'])) echo $withdrawal['withdrawal_id'] ; ?> </b></h4>
                      							<p class="withdraw-list-item__text-description"><?= $this->lang->line('lang_withdrawal_history_withdraw_to') ?> <?php if(isset($withdrawal['w_method'])) echo $withdrawal['w_method']; ?></p>
                    						</div>

                    						<div class="withdraw-list-item__fee">
                      							<span class="withdraw-list-item__fee-delta">-<?php if(isset($withdrawal['updated'])) echo number_format(floatval($withdrawal['final_amount'])); ?></span>
                      							<span class="withdraw-list-item__fee-currency"><?php if(!empty($currency)) echo $currency; else echo 'USD'; ?></span>
                      							<?php if($withdrawal['status'] === '0') {?>
                      								<span class="badge badge-warning"><?= $this->lang->line('lang_withdrawal_history_pending') ?></span>
                      							<?php } else if($withdrawal['status'] === '2') { ?>
                      								<span class="badge badge-success"><?= $this->lang->line('lang_withdrawal_history_paid') ?></span>
                      							<?php } else if($withdrawal['status'] === '3') { ?>
                      								<span class="badge badge-danger"><?= $this->lang->line('lang_withdrawal_history_rejected') ?></span>
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
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>