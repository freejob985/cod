<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title><?= $this->lang->line('lang_invoices_title') ?> | <?php echo $this->lang->line('site_name') ?>| <?= $this->lang->line('lang_userdashbaord_title') ?></title>
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
				<h3><?= $this->lang->line('lang_cp_title') ?></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?= base_url() ?>user"><?= $this->lang->line('lang_user_home') ?></a></li>
						<li><?= $this->lang->line('lang_cp_title') ?></li>
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
							<h3><i class="mdi mdi-fax"></i> <?php echo count($invoices).$this->lang->line('lang_invoices_no_of_inv'); ?></h3>
						</div>

						<div class="content">

							<!-- Row -->
							<?php if(!empty($invoices)) { ?>
							<div class="row">

							<!-- Dashboard Box -->
							<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3><?= $this->lang->line('lang_cp_title') ?></h3>
								</div>
								<div class="bs-example container" data-example-id="striped-table">
  									<table class="table table-striped table-bordered table-hover">
    								<thead>
      								<tr>
        								<th>#</th>
        								<th><?= $this->lang->line('lang_invoices_table_header_1') ?></th>
        								<th><?= $this->lang->line('lang_invoices_table_header_2') ?></th>
        								<th><?= $this->lang->line('lang_invoices_table_header_3') ?></th>
      								</tr>
    								</thead>
    								<tbody>

    									<?php $i=1; foreach ($invoices as $invoice) { ?>
      									<tr>
        									<th scope="row"><?php echo $i; ?></th>
        									<th scope="row"><a href="<?php echo base_url().'user/invoice_get/'.$invoice['invoice_id'] ?>"><?php echo $invoice['invoice_id']; ?></a></th>
        									<td><?php if($invoice['status'] === '1') echo 'Paid'; else if($invoice['status'] === '0')
        									echo $this->lang->line('lang_invoice_status_pending'); else if($invoice['status'] === '3')
        									echo $this->lang->line('lang_invoice_status_cancel'); else if($invoice['status'] === '4')
        									echo $this->lang->line('lang_invoice_status_completed');
        									?></td>
        									<td><?php if(isset($invoice['updated'])) echo date('Y-m-d',strtotime($invoice['updated'])); ?></td>
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