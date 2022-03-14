	<!-- Dashboard Sidebar -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title"><?= $this->lang->line('lang_sidebar_title') ?></span>
				</a>
				
				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<a class="navbar-brand brand-logo-mini text-center" href="<?php echo base_url() ?>">
          					<img src="<?php if(isset($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" alt="logo" />
        				</a>

						<ul data-submenu-title="<?= $this->lang->line('lang_sidebar_devider_1') ?>">
							<li><a href="<?php echo site_url('user/dashboard'); ?>"><i class="icon-material-outline-dashboard"></i> <?= $this->lang->line('lang_sidebar_dashboard') ?></a></li>
							<li><a href="<?php echo site_url('chat'); ?>"><i class="icon-material-outline-question-answer"></i> <?= $this->lang->line('lang_sidebar_messages') ?> <span class="nav-tag"><?php echo $messageCount; ?></span></a></li>
						</ul>
						
						<?php if($settings[0]['enable_user_selling'] === '1' || $this->session->userdata('user_level') == '3') { ?>
						<ul data-submenu-title="<?= $this->lang->line('lang_sidebar_devider_4') ?>">
							<li><a href="#"><i class="icon-material-outline-business-center"></i> <?= $this->lang->line('lang_sidebar_listings') ?></a>
								<ul>
									<li><a href="<?php echo site_url('user/create_listings'); ?>"><?= $this->lang->line('lang_sidebar_post_listings') ?></a></li>
									<?php if(in_array('auction',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/manage_listings'); ?>"><?= $this->lang->line('lang_sidebar_manage_auctions') ?><span class="nav-tag"><?php echo $listingCount; ?></span></a></li>
									<?php } ?>
									<?php if(in_array('classified',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/manage_offers'); ?>"><?= $this->lang->line('lang_sidebar_manage_offers') ?><span class="nav-tag"><?php echo $listingOfferCount; ?></span></a></li>
									<?php } ?>
									<li><a href="<?php echo site_url('user/incomplete_listings'); ?>"><?= $this->lang->line('lang_sidebar_incomplete_listi') ?><span class="nav-tag"><?php echo count($incomlistings); ?></span></a></li>
								</ul>	
							</li>
							
							<li><a href="<?php echo site_url('user/invoices'); ?>"><i class="mdi mdi-fax"></i> <?= $this->lang->line('lang_sidebar_invoices') ?> </a></li>
						</ul>
						<?php } ?>

						<ul data-submenu-title="<?= $this->lang->line('lang_sidebar_devider_2') ?>">

							<li class="active-submenu"><a href="#"><i class="mdi mdi-gavel"></i> <?= $this->lang->line('lang_sidebar_bids_offers') ?></a>
								<ul>
									<?php if(in_array('auction',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/pending_bids'); ?>"><?= $this->lang->line('lang_sidebar_active_bids') ?></a></li>
									<?php } ?>
									<?php if(in_array('classified',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/pending_offers'); ?>"><?= $this->lang->line('lang_sidebar_active_offers') ?></a></li>
									<?php } ?>
								</ul>	
							</li>

							<li><a href="#"><i class="icon-material-outline-assignment"></i> <?= $this->lang->line('lang_sidebar_open_contracts') ?> <span class="nav-tag"><?php if(!empty($openContracts)) echo count($openContracts); else echo '0'; ?></span></a>
								<ul>
									<?php foreach ($openContracts as $contract) { ?>
										<li><a href="<?php echo site_url('user/contract/'.$contract['contract_id']); ?>"><?= $this->lang->line('lang_sidebar_contract') ?> - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>	
							</li>

							<li><a href="#"><i class="mdi mdi-briefcase-check"></i> <?= $this->lang->line('lang_sidebar_closed_contracts') ?> <span class="nav-tag"><?php if(!empty($closeContracts)) echo count($closeContracts); else echo '0'; ?></span></a>
								<ul>
									<?php foreach ($closeContracts as $contract) { ?>
										<li><a href="<?php echo site_url('user/closed_contracts/'.$contract['contract_id']); ?>"><?= $this->lang->line('lang_sidebar_contract') ?> - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>	
							</li>

							<?php if(isset($paymentsOptions[3]['status']) && $paymentsOptions[3]['status'] === '1') { ?>
							<li><a href="#"><i class="icon-material-outline-assignment"></i> <?= $this->lang->line('lang_sidebar_escrow_open') ?> <span class="nav-tag"><?php if(!empty($openEscrow)) echo count($openEscrow); else echo '0'; ?></span> <span class="badge badge-warning"> new</span></a>
								<ul>
									<?php foreach ($openEscrow as $contract) { ?>
										<li><a href="<?php echo site_url('user/contract/'.$contract['contract_id']); ?>"><?= $this->lang->line('lang_sidebar_contract') ?> - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>	
							</li>

							<li><a href="#"><i class="mdi mdi-briefcase-check"></i> <?= $this->lang->line('lang_sidebar_escrow_close') ?> <span class="nav-tag"><?php if(!empty($closeEscrow)) echo count($closeEscrow); else echo '0'; ?></span> <span class="badge badge-warning"> new</span></a>
								<ul>
									<?php foreach ($closeEscrow as $contract) { ?>
										<li><a href="<?php echo site_url('user/closed_contracts/'.$contract['contract_id']); ?>"><?= $this->lang->line('lang_sidebar_contract') ?> - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>	
							</li>
							<?php } ?>

						</ul>

						<ul data-submenu-title="<?= $this->lang->line('lang_sidebar_devider_5') ?>">
							<?php if($settings[0]['enable_user_selling'] === '1' || $this->session->userdata('user_level') == '3') { ?>
								<li><a href="<?php echo site_url('user/withdrawals'); ?>"><i class="mdi mdi-currency-usd"></i> <?= $this->lang->line('lang_sidebar_withdrawals') ?></a></li>
							<?php } ?>
							<?php if(file_exists(APPPATH.'/libraries/Referral_Module.php')) { ?>
								<li><a href="<?php echo site_url('refferal/user_referral'); ?>"><i class="icon-material-outline-star"></i> <?= $this->lang->line('lang_sidebar_refferal') ?></a></li>
							<?php } ?>
							<li><a href="<?php echo site_url('user/user_settings'); ?>"><i class="icon-material-outline-settings"></i> <?= $this->lang->line('lang_sidebar_settings') ?></a></li>
							<li><a href="<?= !DEMO_MODE ? site_url('user/change_password') : '#' ?>" onclick="<?= DEMO_MODE ? 'disableddemo();' : ''?>"><i class="icon-material-outline-lock"></i><?= $this->lang->line('lang_sidebar_change_password') ?></a></li>
							<li><a href="<?php echo site_url('user/logout'); ?>"><i class="icon-material-outline-power-settings-new"></i> <?= $this->lang->line('lang_sidebar_logout') ?></a></li>
						</ul>
						
					</div>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->