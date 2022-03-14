<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_view_offers_title') ?> | <?php echo $this->lang->line('site_name') ?> | <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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


<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('user/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3><?= $this->lang->line('lang_view_offers_title') ?></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_view_offers_title') ?></li>
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
							<h3><i class="fa fa-users"></i> <?= $this->lang->line('lang_view_offers_sub_title') ?> <a href=""><?php if(isset($Offers[0]['username'])) echo $Offers[0]['username']; ?></a></h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th><?= $this->lang->line('lang_view_bids_table_1') ?></th>
        							<th><?= $this->lang->line('lang_view_bids_table_2') ?></th>
        							<th><?= $this->lang->line('lang_view_bids_table_3') ?></th>
        							<th><?= $this->lang->line('lang_view_bids_table_5') ?></th>
        							<th></th>
      							</tr>
    							</thead>
    							<tbody>

    								<?php $i=1; foreach ($Offers as $Offer) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><?php if(isset($Offer['offer_amount'])) echo $Offer['offer_amount']; ?></td>
        								<td><?php if(isset($Offer['ago'])) echo $Offer['ago']; ?></td>
        								<td><?php if($Offer['offer_status'] === '0') echo $this->lang->line('lang_invoice_status_pending'); else if($Offer['offer_status'] === '1')
        								echo $this->lang->line('lang_view_status_rejected'); else if($Offer['offer_status'] === '2')
        								echo $this->lang->line('lang_view_status_approved'); else if($Offer['offer_status'] === '3')
        								echo $this->lang->line('lang_view_status_canceled'); ?></td>
        								<td><?php if(isset($Offer['expire'])) echo $Offer['expire']; ?></td>
        								<td class="centerButtons">
        								<?php if($Offer['offer_status'] === '0') { ?>
        									<button type="button" class="btn btn-outline-dark btn-sm cancel_offer" data-offerid="<?php echo $Offer["offer_id"];?>"><?= $this->lang->line('lang_view_bids_cancel') ?></button> 
        									<?php } ?>
      									</td>
      								</tr>
      								<?php $i++; } ?>
    							</tbody>
  							</table>
						</div>
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