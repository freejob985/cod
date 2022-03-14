<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_escrow_contract_title') ?> - <?php if(!empty($contract[0]['contract_id'])) { echo '#'.$contract[0]['contract_id']; } ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--User Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="load_thread(<?php if(isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>);">

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
			<?php if(isset($contract[0]['id']) && !empty($contract[0]['id'])) { ?>
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<img src="<?php echo base_url() ?>assets/img/escrow-logo.png" style='width: 30%'>
				<h3><?php if ($contract[0]['status'] === '4' || $contract[0]['status'] === '7'){ ?><a href="#" class="text-danger"> <?= $this->lang->line('lang_escrow_contract_closed') ?> </a><?php } else { ?><a href="#" class="text-success"> <?= $this->lang->line('lang_escrow_contract_open') ?> </a> <?php } ?> | <?= $this->lang->line('lang_escrow_contract_tag') ?> <a href="<?php echo current_url(); ?>"><?php if(isset($contract[0]['firstname'])) echo $contract[0]['firstname'] ?> <?php if(isset($contract[0]['lastname'])) echo $contract[0]['lastname']; ?></a></h3>
				<span class="margin-top-7"> # <a href="<?php echo current_url(); ?>"><?php if(isset($contract[0]['contract_id'])) echo $contract[0]['contract_id']; ?></a> | <strong> <?php echo  strtoupper($role); ?> </strong> </span>
				<span class="margin-top-7">
				<?php if($role === 'seller') {foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'buyer') if(!$parties['agreed']) {  ?> <div class="badge badge-info"> <?= $this->lang->line('lang_escrow_btn_agreement') ?> </div> <?php } } } 
				if($role === 'buyer') { foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'seller') if(isset($parties['next_step'])) {  ?> <div class="badge badge-info"> <?= $this->lang->line('lang_escrow_btn_awaiting_seller') ?> </div> <?php } } }
				if($role === 'seller') {foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'buyer') if($parties['agreed'] && isset($parties['next_step'])) {  ?> <div class="badge badge-info"> <?= $this->lang->line('lang_escrow_btn_awaiting_buyer') ?> </div> <?php } } 
					if($escrow_transaction['items'][0]['schedule'][0]['status']['secured']) { ?>
						<div class="badge badge-success"> <?= $this->lang->line('lang_escrow_payment_secured') ?></div>
					<?php } else {?>
						<div class="badge badge-danger"> <?= $this->lang->line('lang_escrow_payment_pending') ?></div>
					<?php }
				} ?>
				</span>
				<span class="margin-top-7">
				<?php if($contract[0]['status'] === '10'){ ?>
					<div class="badge badge-warning"> <?= $this->lang->line('lang_escrow_payment_verification') ?></div>
				<?php } 

				if(empty($escrow_transaction['items'])){ ?>
					<div class="badge badge-danger"> <?= $this->lang->line('lang_escrow_payment_error') ?></div>
				<?php } ?>
            	</span>



				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_escrow_contract_title') ?></li>
					</ul>
				</nav>
			</div>

			<div id="paymentView" class="row">

				<div class="col-xl-12">
				<div class="dashboard-box margin-top-0">
				<div class="content">
				<ul class="dashboard-box-list">

				<li class="domains-box active bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">

					<div class="lable text-center pt-2 pb-2">
                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                            <li class="list-inline-item"><i class="mdi mdi-bell-ring"></i></li>
                        </ul>
                    </div>

					<!-- Overview -->
					<div class="seller-overview manage-candidates">
						<div class="seller-overview-inner">

							<!-- Thumbnail -->
							<div class="seller-avatar">
								<div class="verified-badge"></div>
								<a href="#"><img src="<?php if(!empty($listing_data[0]['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing_data[0]['website_thumbnail']; ?>" alt=""></a>
							</div>

							<!-- Name -->
							<div class="seller-name ">
								<h4><strong><?php if(isset($escrow_transaction['description'])) echo strtoupper($escrow_transaction['description']); ?></strong></h4>
								<h4><a href="#"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> <?php if(!empty($biddata[0]['user_country'])){?>  <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php echo strtolower($biddata[0]['user_country']); ?>.svg " alt="" title="<?php if(isset($biddata[0]['user_country'])) echo $biddata[0]['user_country'] ?>"data-tippy-placement="top"><?php } ?></a>&nbsp;<?php if(isset($contract[0]['customer_id']) && !empty($contract[0]['customer_id'])) { ?><span id="FirstStep" class="badge badge-success text-white"><?= $this->lang->line('lang__model_bid_history_highest') ?> <?php echo strtoupper($contract[0]['type']); ?> </span> <?php } ?></h4>

								<!-- Details -->
								<span class="seller-detail-item"><a href="<?php echo site_url('user_profile/'.$contract[0]['username']) ?>"><i class="icon-feather-user"></i> <?php if(isset($contract[0]['firstname'])) echo $contract[0]['firstname'].' '.$contract[0]['lastname']; ?></a></span>

								<?php foreach ($escrow_transaction['parties'] as $parties) { 
									if($role === $parties['role']){ 
										if(!$parties['agreed']){ ?>
											<div class="badge badge-info"> <?= $this->lang->line('lang_escrow_btn_awaiting_common') ?></div>
										<?php }
									?>
								<?php } } ?>


								<br><span class="seller-detail-item"><a href="#"><i class="icon-feather-time"></i> <?= $this->lang->line('lang_escrow_created_on_slippa') ?>: <?php if(isset($escrow_transaction['creation_date'])) echo date('Y-m-d',strtotime($escrow_transaction['creation_date'])); ?></a></span>

								<!-- Bid Details -->
								<ul class="dashboard-task-info bid-info">
									<?php if($contract[0]['bid_id'] === 'direct'){ ?> <li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(!empty($contractamount )) echo number_format($contractamount); ?></strong><span><?= $this->lang->line('lang_contract_amount_c') ?></span></li><?php } else { ?> <li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($biddata[0]['bid_amount'])) echo number_format($biddata[0]['bid_amount']); ?></strong><span><?php echo strtoupper($contract[0]['type'])?> <?= $this->lang->line('lang_contract_amount') ?></span></li> <?php } ?>
									<li><strong><?php if(isset($contract[0]['delivery'])) echo $contract[0]['delivery']; ?> <?= $this->lang->line('lang_contract_days') ?></strong><span><?= $this->lang->line('lang_contract_delivery') ?></span></li>
									<li><strong><?php if(isset($t_id)) echo $t_id; ?></strong><span><?= $this->lang->line('lang_escrow_t_id') ?></span></li>
									<?php foreach ($escrow_transaction['items'][0]['fees'] as $fees) { 
									if($fees['type'] === 'escrow'){ ?>
									<li><strong><?php if(isset($fees['amount'])) echo strtoupper($escrow_transaction['currency']).' '.$fees['amount']; ?></strong><span><?= $this->lang->line('lang_escrow_fee') ?></span></li>
									<?php } } ?>
									
								</ul>

								<!-- Add to cart -->
								<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
									<?php foreach ($escrow_transaction['parties'] as $parties) { 
									if($role === $parties['role']){ 
										if(!$parties['agreed']){ ?>
											<a href="<?php if(isset($parties['next_step'])) echo $parties['next_step']; ?>" target="_blank" class="button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_escrow_terms') ?> </a>
										<?php }

										if($role === 'buyer' && $parties['agreed']){ if(!$escrow_transaction['items'][0]['schedule'][0]['status']['secured'] && !empty($escrow_transaction['items'])) {  ?>
											<a href="#" class="button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?php echo 'Total amount without payment fee | '.$payment_methods['total_without_payment_fee']; ?>  </a>
											<p class="text-dark"><strong><?= $this->lang->line('lang_escrow_pay_options') ?></strong></p>
											<?php foreach ($payment_methods['available_payment_methods'] as $payoptions) { ?>
												<a href="#" data-tid="<?php echo $escrow_transaction['id'] ?>" data-method="<?php echo $payoptions['type'] ?>" target="_blank" class="button dark ripple-effect pay_escrow"><i class="mdi mid-hand-okay"></i> <?php echo $payoptions['type'] .' | '.$payoptions['total'];  ?>  </a>	
											<?php } ?>

											<?php if(isset($payment_methods['conditionally_available_payment_methods'])){ ?>
											<p class="text-dark"><strong><?= $this->lang->line('lang_escrow_pay_options_con') ?></strong></p> 
											<?php foreach ($payment_methods['conditionally_available_payment_methods'] as $payoptions) { ?>
												<a href="#" class="button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?php echo $payoptions['type'] .' | '.$payoptions['total'].' | '.$payoptions['conditions'][0];  ?>  </a>	
											<?php } } } }

											if($role === 'seller' && $parties['agreed']){
												if(!empty($parties['next_step'])){ ?>
													<a href="<?php echo $parties['next_step']; ?>" target="_blank" class="button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_escrow_btn_go_next') ?>  </a>
											<?php  } } 

											if($role === 'seller' && $parties['agreed']){
												if(empty($escrow_transaction['items']) && $contract[0]['status'] !== '7' && $contract[0]['status'] !== '4'){ ?>
													<a href="" target="_blank" class="button dark ripple-effect cancel_manual" data-tid="<?php echo $escrow_transaction['id'] ?>"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_escrow_btn_mark_contract') ?>  </a>
											<?php  } } } ?>

									<?php  } ?>

									<?php if($role === 'buyer') { foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'buyer') if($parties['agreed'] && isset($parties['next_step'])) {  ?> <a href="<?php echo $parties['next_step']; ?>" target="_blank" class="button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_escrow_btn_go_next') ?>  </a> <?php } } } ?>

									<div id="notification"></div>
									<span id="loadercontract" style="display:none;" class="text-center"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
								</div>

							</div>
						</div>
					</div>
				</li>
				<div id="payment-info-det" class="margin-top-10 domains-box active bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden"></div>
				</ul>
				<!-------EnDs---------------->
				</div>
				</div>
				</div>

			</div>

			<!-- Row -->
			<div id="contract_history" class="row margin-top-25">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><strong><?= $this->lang->line('lang_escrow_contract_history') ?></strong></h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th><?= $this->lang->line('lang_escrow__history') ?></th>
      							</tr>
    							</thead>
    							<tbody>
      								<tr>
        								<td><?= $this->lang->line('lang_escrow_contract_created') ?> <strong><?php if(isset($escrow_transaction['creation_date'])) echo date('Y-m-d',strtotime($escrow_transaction['creation_date'])); ?></strong> <?= $this->lang->line('lang_escrow_contract_for') ?> <strong><?php if(isset($escrow_transaction['description'])) echo $escrow_transaction['description']; ?></strong></td>
      								</tr>
      								<?php foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'buyer') if($parties['agreed']) {  ?>
      								<tr>
        								<td> <?= $this->lang->line('lang_escrow_contract_buyer_ag') ?>  | <strong> <?= $this->lang->line('lang_escrow_contract_buyer_em') ?>  : </strong> <?php echo $parties['customer']; ?></td>
      								</tr>
									<?php } } ?>
									<?php foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'seller') if($parties['agreed']) {  ?>
      								<tr>
        								<td> <?= $this->lang->line('lang_escrow_contract_sell_ag') ?> | <strong> <?= $this->lang->line('lang_escrow_contract_sell_em') ?> : </strong> <?php echo $parties['customer']; ?></td>
      								</tr>
									<?php } } ?>
									<?php foreach ($escrow_transaction['parties'] as $parties) { if($parties['role'] === 'broker') if($parties['agreed']) {  ?>
      								<tr>
        								<td> <?= $this->lang->line('lang_escrow_contract_brkr_ag') ?> | <strong> <?= $this->lang->line('lang_escrow_contract_brkr_em') ?> : </strong> <?php echo $parties['customer']; ?></td>
      								</tr>
									<?php } } ?>
									<?php if($escrow_transaction['items'][0]['schedule'][0]['status']['secured']) { ?>
									<tr>
										<td> <?= $this->lang->line('lang_escrow_contract_pay_1') ?> <strong><?php echo strtoupper($escrow_transaction['currency']).' '.$escrow_transaction['items'][0]['schedule'][0]['amount']; ?> </strong> <?= $this->lang->line('lang_escrow_contract_pay_2') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['shipped']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_seller_tagline_1') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['shipped_returned']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_buyer_tagline_1') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['received']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_buyer_tagline_2') ?> <strong><?php if(isset($escrow_transaction['items'][0]['status']['received_date'])) echo date('Y-m-d',strtotime($escrow_transaction['items'][0]['status']['received_date'])); ?></strong></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['received_returned']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_info_tagline_1') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['in_dispute']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_info_tagline_2') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['canceled']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_info_tagline_3') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['accepted_returned']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_info_tagline_4') ?></td>
									</tr>
									<?php } ?>
									<?php if($escrow_transaction['items'][0]['status']['accepted']) { ?>
									<tr>
										<td><?= $this->lang->line('lang_escrow_info_tagline_5_1') ?><strong><?= $this->lang->line('lang_escrow_info_tagline_5_2') ?></strong></td>
									</tr>
									<tr>
										<td><strong><?= $this->lang->line('lang_escrow_info_tagline_6') ?></strong></td>
									</tr>
									<?php } ?>
    							</tbody>
  							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
	
			<!-- Row -->
			<?php if($contract[0]['status'] === '0' || $contract[0]['status'] === '10' || $contract[0]['status'] === '11') { ?>
			<div id="deliveryView" class="row">
			<?php } else { ?>
			<div id="deliveryView" class="row" style="display: none;">
			<?php } ?>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-users"></i></h3>
						</div>

						<div class="content">
						<!-- Message Content -->
						<div class="message-content">

							<div class="messages-headline">
								<input type="hidden" name="chat_buddy_id" id="chat_buddy_id" value="<?php if(isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>">
								<h4 id="ChatName"><?= $this->lang->line('lang_message_convo') ?>  <?php if(isset($contract[0]['username'])) echo $contract[0]['username']; ?></h4>
								<a href="#" class="message-action"><i class="icon-feather-trash-2"></i> <?= $this->lang->line('lang_message_delete') ?></a>
							</div>
							
							<!-- Message Content Inner -->
							<div id="chat-message" class="message-content-inner">
								<!----message loading bubble-->
								<div id="message-loading" class="message-bubble" style="display: none;">
									<div class="message-bubble-inner">
										<div class="message-avatar"></div>
										<div class="message-text">
											<!-- Typing Indicator -->
											<div class="typing-indicator">
												<span></span>
												<span></span>
												<span></span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<!----/Ends message loading bubble-->

							</div>
							<!-- Message Content Inner / End -->
							
							<!-- Reply Area -->
							<div class="message-reply">
								<textarea id="chat_message" class="chat-textarea" cols="1" rows="1" placeholder="Your Message" data-autoresize></textarea>
								<button class="button ripple-effect sendMsg"><?= $this->lang->line('lang_model_message_send_btn') ?></button>
							</div>

						</div>
						<!-- Message Content -->

						<div>
							
						</div>


						</div>

					</div>
				</div>

			</div>
			<!-- Row / End -->
			<?php } else { ?>

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">
						<!-- Headline -->
						<div class="headline">
							<h3><?= $this->lang->line('errorNoContracts') ?></h3>
						</div>
					</div>
				</div>
			</div>

			<?php } ?>

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


<!-----------------Common Models -------------------------------------------------------------------------------->
<?php $this->load->view('user/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>