<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_contract_title') ?> - <?php if(!empty($contract[0]['contract_id'])) { echo '#'.$contract[0]['contract_id']; } ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--User Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="bootChat();load_thread(<?php if(isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>);">

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
				<h3><?= $this->lang->line('lang_contract_tagline') ?> <a href="<?php echo current_url(); ?>"><?php if(isset($contract[0]['firstname'])) echo $contract[0]['firstname'] ?> <?php if(isset($contract[0]['lastname'])) echo $contract[0]['lastname']; ?></a></h3>
				<span class="margin-top-7"> # <a href="<?php echo current_url(); ?>"><?php if(isset($contract[0]['contract_id'])) echo $contract[0]['contract_id']; ?></a>  <?php if ($contract[0]['status'] === '4' || $contract[0]['status'] === '7'){?>
                <div class="badge badge-danger"> <?= $this->lang->line('lang_escrow_contract_closed') ?></div> <?php } ?></span>
				<span class="margin-top-7">
				<?php if ($contract[0]['status'] === '0' ){?>
                <div class="badge badge-info"> <?= $this->lang->line('lang_status_pending_payment') ?></div>
                <?php } else if ($contract[0]['status'] === '1' ) { ?>
                <div class="badge badge-success"><?= $this->lang->line('lang_status_contract_paid') ?></div>
                <?php } else if ($contract[0]['status'] === '2' ) { ?>
                <div class="badge badge-danger"><?= $this->lang->line('lang_status_resolution_mnger') ?></div>
                <?php } else if ($contract[0]['status'] === '3' ) { ?>
                <div class="badge badge-danger"><?= $this->lang->line('lang_status_canceled_buyer') ?></div>
                <?php } else if ($contract[0]['status'] === '4' ) { ?>
                <div class="badge badge-warning"><?= $this->lang->line('lang_status_sale_comepleted') ?></div>	
                <?php } else if ($contract[0]['status'] === '5' ) { ?>
                <div class="badge badge-dark"><?= $this->lang->line('lang_status_delivered') ?></div>
                <?php } else if ($contract[0]['status'] === '6' ) { ?>
                <div class="badge badge-warning"><?= $this->lang->line('lang_status_on_revision') ?></div>
            	<?php } else if ($contract[0]['status'] === '8' ) { ?>
                <div class="badge badge-warning"><?= $this->lang->line('lang_status_reject_cancel') ?></div>
            	<?php } else if ($contract[0]['status'] === '9' ) { ?>
                <div class="badge badge-warning"><?= $this->lang->line('lang_status_raised_dispute') ?></div>
            	<?php } else if ($contract[0]['status'] === '7' ) { ?>
                <div class="badge badge-warning"><?= $this->lang->line('lang_status_cancel_refunded') ?></div>
                <?php } ?>
            	</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_contract_sub') ?></li>
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
                            <?php if ($contract[0]['status'] === '0' ){?>
                            <li class="list-inline-item"><i class="mdi mdi-bell-ring"></i></li>
                            <?php } else if ($contract[0]['status'] === '1' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-credit-card-outline"></i></li>
                            <?php } else if ($contract[0]['status'] === '2' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-face-agent"></i></li>
                            <?php } else if ($contract[0]['status'] === '3' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-close-circle"></i></li>
                            <?php } else if ($contract[0]['status'] === '4' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-check-outline"></i></li>	
                            <?php } else if ($contract[0]['status'] === '5' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-truck-delivery"></i></li>
                            <?php } else if ($contract[0]['status'] === '6' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                            <?php } else if ($contract[0]['status'] === '7' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                            <?php } else if ($contract[0]['status'] === '8' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                        	<?php } else if ($contract[0]['status'] === '9' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                            <?php } ?>
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
								<h4><a href="#"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> <?php if(!empty($biddata[0]['user_country'])){?>  <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php echo strtolower($biddata[0]['user_country']); ?>.svg " alt="" title="<?php if(isset($biddata[0]['user_country'])) echo $biddata[0]['user_country'] ?>"data-tippy-placement="top"><?php } ?></a>&nbsp;<?php if(isset($contract[0]['customer_id']) && !empty($contract[0]['customer_id'])) { ?><span id="FirstStep" class="badge badge-success text-white"><?= $this->lang->line('lang__model_bid_history_highest') ?> <?php echo strtoupper($contract[0]['type']); ?> </span> <?php } ?></h4>

								<!-- Details -->
								<span class="seller-detail-item"><a href="<?php echo site_url('user_profile/'.$contract[0]['username']) ?>"><i class="icon-feather-user"></i> <?php if(isset($contract[0]['firstname'])) echo $contract[0]['firstname'].' '.$contract[0]['lastname']; ?></a></span>

								<?php if($contract[0]['status'] === '0') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-warning text-white"><?= $this->lang->line('lang_invoice_status_pending_payment') ?></span></a></span>
								<?php } else if($contract[0]['status'] === '1') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-success text-white"><?= $this->lang->line('lang_invoice_status_paid') ?> </span></a></span>
								<?php } else if($contract[0]['status'] === '2') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-danger text-white"><?= $this->lang->line('lang_invoice_support_review') ?> </span></a></span>
								<?php } else if($contract[0]['status'] === '3') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-danger text-white"><?= $this->lang->line('lang_status_cancel_contract') ?> </span></a></span>
								<?php } else if($contract[0]['status'] === '6') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-danger text-white"><?= $this->lang->line('lang_status_requested_revision') ?> </span></a></span>
								<?php } else if($contract[0]['status'] === '4') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white"><?= $this->lang->line('lang_c_comepleted') ?> </span></a></span>
								<?php } else if($contract[0]['status'] === '5') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white"><?= $this->lang->line('lang_status_delivered_approval') ?></span></a></span>
								<?php } else if($contract[0]['status'] === '7') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white"><?= $this->lang->line('lang_status_cancel_refunded') ?></span></a></span>
								<?php } else if($contract[0]['status'] === '8') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white"><?= $this->lang->line('lang_status_reject_cancel') ?></span></a></span>
								<?php } else if($contract[0]['status'] === '9') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white"><?= $this->lang->line('lang_status_raised_dispute') ?></span></a></span>
								<?php } ?>

								<br><span class="seller-detail-item"><a href="#"><i class="icon-feather-time"></i> <?= $this->lang->line('lang_status_updated_on') ?> : <?php if(isset($contract[0]['date'])) echo date('Y-m-d',strtotime($contract[0]['date'])); ?></a></span>

								<!-- Bid Details -->
								<ul class="dashboard-task-info bid-info">
									<?php if($contract[0]['bid_id'] === 'direct'){ ?> <li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(!empty($contractamount )) echo number_format($contractamount); ?></strong><span>Contract Amount</span></li><?php } else { ?> <li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($biddata[0]['bid_amount'])) echo number_format($biddata[0]['bid_amount']); ?></strong><span><?php echo strtoupper($contract[0]['type'])?> <?= $this->lang->line('lang_contract_amount') ?></span></li> <?php } ?>
									<li><strong><?php if(isset($contract[0]['delivery'])) echo $contract[0]['delivery']; ?> <?= $this->lang->line('lang_contract_days') ?></strong><span><?= $this->lang->line('lang_contract_delivery') ?></span></li>
								</ul>

								<!-- Add to cart -->
								<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
									<?php if ($contract[0]['status'] === '0' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="<?php echo base_url().'checkout/'.'contract'.'/'.$contract[0]['id']; ?>" class="text-warning"><i class="mdi mdi-credit-card-scan"></i> <?= $this->lang->line('lang_btn_pay_now') ?></a>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '1' || $contract[0]['status'] === '6' ){ 
										if($contract[0]['owner_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-7" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_contract_delivery_complete') ?></a>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '3' ){ 
										if($contract[0]['owner_id'] === $this->session->userdata('user_id')) { ?>
											<button type="button" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect float-left accept_cancel"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_contract_accept_cancel') ?></button>
											<button type="button" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect float-left reject_cancel"><i class="mdi mid-hand-okay"></i><?= $this->lang->line('lang_contract_reject_cancel') ?></button>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '5' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-4" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_model_accept_deliver_button') ?> </a>
											<a href="#small-dialog-5" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button red ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_model_request_revision_title') ?> </a>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '8' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-4" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_model_accept_deliver_button') ?> </a>
											<a href="" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="button dark ripple-effect raise_dispute"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_status_raised_dispute') ?> </a>
									<?php } } ?>
									

									<?php if ($contract[0]['status'] === '4' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-2" class="popup-with-zoom-anim badge badge-light"><i class="icon-material-outline-thumb-up"></i> <?= $this->lang->line('lang_model_leave_review_button') ?></a>
									<?php } } ?>

									<span id="loadercontract" style="display:none;" class="text-center"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
								</div>
							</div>
						</div>
					</div>
				</li>
				</ul>
				<!-------EnDs---------------->
				</div>
				</div>
				</div>

			</div>

			<!-- Row -->
			<?php if(!empty($contractsHistory)) { ?>
			<div id="contract_history" class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><?= $this->lang->line('lang_contract_history_title') ?></h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th><?= $this->lang->line('lang_contract_history_status') ?></th>
        							<th><?= $this->lang->line('lang_contract_history_remarks') ?></th>
        							<th><i class="fas fa-arrow-circle-up"></i></th>
        							<th><?= $this->lang->line('lang_contract_history_date') ?></th>
      							</tr>
    							</thead>
    							<tbody>

    								<?php $i=1; foreach ($contractsHistory as $contracts) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><?php if($contracts['status'] === '1') echo $this->lang->line('lang_invoice_status_paid'); else if($contracts['status'] === '2')
        								echo $this->lang->line('lang_invoice_support_review'); else if($contracts['status'] === '3')
        								echo $this->lang->line('lang_status_cancel_contract'); else if($contracts['status'] === '6')
        								echo $this->lang->line('lang_status_requested_revision'); else if($contracts['status'] === '4')
        								echo $this->lang->line('lang_c_comepleted'); else if($contracts['status'] === '5')
        								echo $this->lang->line('lang_status_delivered_approval'); else if($contracts['status'] === '7')
        								echo $this->lang->line('lang_status_cancel_refunded');else if($contracts['status'] === '8')
        								echo $this->lang->line('lang_status_reject_cancel_reqe');else if($contracts['status'] === '9')
        								echo $this->lang->line('lang_status_raised_dispute_buy');
        								?></td>
        								<td><?php if(!empty($contracts['remarks'])) echo $contracts['remarks']; ?></td>
        								<td><?php if(!empty($contracts['uploads'])) echo '<a href="'.base_url().FILES_UPLOAD.$contracts['uploads'].'">'.'<i title="Download Attachment" data-toggle="tooltip" class="fas fa-arrow-circle-down text-warning">'.'</a>'; ?></td>
        								<td><?php if(!empty($contracts['date'])) echo date('Y-m-d',strtotime($contracts['date'])); ?></td>
      								</tr>
      								<?php $i++; } ?>
    							</tbody>
  							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
			<?php } ?>
	
			<!-- Row -->
			<?php if($contract[0]['status'] === '1' || $contract[0]['status'] === '6') { ?>
			<div id="deliveryView" class="row">
			<?php } else { ?>
			<div id="deliveryView" class="row" style="display: none;">
			<?php } ?>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-time"></i> <?= $this->lang->line('lang_contract_time_left') ?></h3>
						</div>

						<div class="container-timeleft" id="container">
							<h1 id="days"></h1>
							<h1 id="time">00:00:<span>00</span></h1>
							<h2 id="code"></h2>
							<?php if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
							<div class="button-group" id="action">
								<a href="#small-dialog-6" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> <?= $this->lang->line('lang_model_cancel_contract_button') ?></a>
							</div>
							<?php } ?>
						</div>

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-users"></i> <?php ?></h3>
						</div>

						<div class="content">
						<!-- Message Content -->
						<div class="message-content">

							<div class="messages-headline">
								<input type="hidden" name="chat_buddy_id" id="chat_buddy_id" value="<?php if(isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>">
								<h4 id="ChatName"><?= $this->lang->line('lang_message_convo') ?> <?php if(isset($contract[0]['username'])) echo $contract[0]['username']; ?></h4>
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
<script>
	dateval = <?php echo date("Y", strtotime($contract[0]['delivery_time'])); ?> + '-' + <?php echo date("m", strtotime($contract[0]['delivery_time'])); ?> + '-' + <?php echo date("d", strtotime($contract[0]['delivery_time'])); ?>;
	timeval = <?php echo date("H", strtotime($contract[0]['delivery_time'])); ?> + ':' + <?php echo date("i", strtotime($contract[0]['delivery_time'])); ?>;

	timeleft();

</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>