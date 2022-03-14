<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_refferal_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
				<h3><?= $this->lang->line('lang_refferal_title') ?></h3>
				<span class="margin-top-7"><?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?> <?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?> <a href=""></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_userdashbaord_title') ?></a></li>
						<li><?= $this->lang->line('lang_refferal_title') ?></li>
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
							<h3><i class="mdi mdi-currency-usd"></i> <?= $this->lang->line('lang_refferal_settings_title') ?></h3>
						</div>

						<form>
						<div class="content  with-padding padding-bottom-0">
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_refferal_id') ?></h5>
										<input id="referral_code" name="referral_code" type="text" class="with-border" value="<?= $userdata[0]['referral_code'] ?>" readonly="true">
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5><?= $this->lang->line('lang_refferal_link') ?></h5>
										<div class="input-group-prepend">
											<input id="copy-ref-url" type="text" value="<?= base_url().'signup?referrer='.$userdata[0]['referral_code'] ?>" class="with-border">
											<button type="button" class="copy-url-button ripple-effect" data-clipboard-target="#copy-ref-url" title="<?php echo $this->lang->line('lang_pop_copy');  ?>" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
										</div>
									</div>
								</div>

							</div>
							<!--- /row ------>
						</div>
						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						</form>

					</div>
				</div>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-30">

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
												<span><?= $this->lang->line('lang_refferal_total_reffers') ?></span>
												<h4><?= count($refferal_users); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-account"></i></a>
										</div>

										<div class="fun-fact" data-fun-fact-color="#9bcd78">
											<div class="fun-fact-text">
												<span><?= $this->lang->line('lang_reffered_earnings') ?></span>
												<h4><?php if(!empty($refferals[0]['commission'])) echo number_format(floatval($refferals[0]['commission']),2); ?></h4>
											</div>
											<a class="withdraw-card__header-link" href="#"><i class="mdi mdi-av-timer"></i></a>
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
						<form id="withdrawFormRefferal" name="withdrawFormRefferal" method="post" enctype="multipart/form-data"/>
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
							<nav class="pagination paginationWithdrawalsRef">
								<ul>
									<?php if(isset($links)) { echo $links; }?>
								</ul>
							</nav>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination / End -->
					</div>

					
				</div>

				<div class="col-xl-12">
					<div class="dashboard-box margin-top-20">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="mdi mdi-currency-usd"></i> <?= $this->lang->line('lang_refferal_title_referrals') ?></h3>
						</div>

						<div class="content  with-padding padding-bottom-0">
							<!--- row ------>
							<div class="row">
								<div class="col-xl-12">
              						<div class="withdraw-alert alert alert-info">
                						<img class="my-alert__icon" src="./images/icon-alert.svg" alt>
                						<span class="my-alert__text">
                  							<?= $this->lang->line('lang_refferal_users') ?>
                						</span>
              						</div>

              					<!-- Begin Pending card -->
              					<div class="withdraw-card card">
                					<div class="withdraw-card__header card-header">
                  						<h3 class="withdraw-card__header-title card-title"><?= $this->lang->line('lang_refferal_users') ?></h3>
                					</div>

                					<?php foreach ($refferal_users as $reffer) { ?>
   
                					<ul class="withdraw-list list-group list-group-flush">
                						<!----Item ----->
                  						<li class="withdraw-list-item list-group-item">
                    						<div class="withdraw-list-item__date">
                      							<span class="withdraw-list-item__date-day"><?php if(isset($reffer['date'])) echo date("d", strtotime($reffer['date'])); ?></span>
                      							<span class="withdraw-list-item__date-month"><b><?php if(isset($reffer['date'])) echo date("M", strtotime($reffer['date'])); ?></b></span>
                    						</div>

                    						<div class="withdraw-list-item__text">
                      							<h4 class="withdraw-list-item__text-title"><b><?php if(isset($reffer['firstname'])) echo $reffer['firstname'] ; ?> </b></h4>
                      							<p class="withdraw-list-item__text-description"><?= $this->lang->line('lang_refferal_from') ?> <?php if(isset($reffer['user_country'])) echo $reffer['user_country']; ?></p>
                      							<br>
                      							<p class="withdraw-list-item__text-description text-warning"> <?= $this->lang->line('lang_reffered_by') ?> <b> <?= $this->lang->line('lang_reffered_by_you') ?> </b></p>
                    						</div>

                    						<div class="withdraw-list-item__fee">
                    							
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
									<?php if(isset($linksRef)) { echo $linksRef; }?>
								</ul>
							</nav>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination / End -->
					</div>

					
				</div>
				
			</div>
			<!-- Row / End -->

			</div>

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