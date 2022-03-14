<!----------------------------------------------------------------------------------------------------------->
<!-- footer -->
<div id="footer">
	
	<!-- Footer Top Section -->
	<div class="footer-top-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">

					<!-- Footer Rows Container -->
					<div class="footer-rows-container">
						
						<!-- Left Side -->
						<div class="footer-rows-left">
							<div class="footer-row">
								<div class="footer-row-inner footer-logo">
									<img src="<?php if(!empty($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="">
								</div>
							</div>
						</div>
						
						<!-- Right Side -->
						<div class="footer-rows-right">

							<!-- Social Icons -->
							<div class="footer-row">
								<div class="footer-row-inner">
									<ul class="footer-social-links">
										<?php if(!empty($settings[0]['user_facebook'])) { ?>
										<li>
											<a href="<?php echo $settings[0]['user_facebook']; ?>" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-facebook-f"></i>
											</a>
										</li>
										<?php } 
										if(!empty($settings[0]['user_twitter'])) { ?>
										<li>
											<a href="<?php echo $settings[0]['user_twitter']; ?>" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-twitter"></i>
											</a>
										</li>
										<?php }
										if(!empty($settings[0]['user_Instagram'])) { ?> 
										<li>
											<a href="<?php echo $settings[0]['user_Instagram']; ?>" title="Instagram" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-instagram"></i>
											</a>
										</li>
										<?php }
										if(!empty($settings[0]['user_github'])) { ?> 
										<li>
											<a href="<?php echo $settings[0]['user_github']; ?>" title="Github" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-github"></i>
											</a>
										</li>
										<?php }
										if(!empty($settings[0]['user_google'])) { ?> 
										<li>
											<a href="<?php echo $settings[0]['user_google']; ?>" title="Google Plus" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-google-plus-g"></i>
											</a>
										</li>
										<?php } ?>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>
							
							<!-- Currency Switcher -->
							<div class="footer-row">
								<div class="footer-row-inner">
									<select class="selectpicker currency-switcher" data-selected-text-format="count" data-size="5" disabled="true">
										<option value="<?php echo $settings[0]['default_currency']; ?>"><?php if(!empty($settings[0]['default_currency'])) echo $settings[0]['default_currency']; else 'USD' ?></option>
									</select>
								</div>
							</div>
						</div>

					</div>
					<!-- Footer Rows Container / End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Top Section / End -->

	<!-- Footer Middle Section -->
	<div class="footer-middle-section">
		<div class="container">
			<div class="row">

				<!-- Links -->
				<?php if(in_array('website',array_column($platforms,'platform'))) { ?>
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3><?php echo $this->lang->line('lang_header_footer_categories'); ?></h3>
						<ul>
							<?php $i=0; foreach ($categoriesData as $category) { if($i <= FOOTER_CAT_NOS) { ?>
							<!-- Category Box -->
							<li><a href="<?php echo base_url() ?>main/category/<?php echo $category['url_slug']; ?>"><span><?php echo $category["c_name"] ?></span></a></li>
							<?php $i++;  } } ?>
						</ul>
					</div>
				</div>
				<?php } ?>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3><?php echo $this->lang->line('lang_header_footer_buyer&sellers'); ?></h3>
						<ul>
							<li><a href="<?php echo base_url()?>pricing"><span><?php echo $this->lang->line('lang_header_footer_plans&pricings'); ?></span></a></li>
							<li><a href="<?php echo base_url() ?>user/create_listings"><span><?php echo $this->lang->line('lang_header_main_start_selling'); ?></span></a></li>
							<?php if(in_array('website',array_column($platforms,'platform'))) { ?>
                                <li><a href="<?php echo base_url().'websites' ?>"><?php echo $this->lang->line('lang_header_main_sub_website'); ?></a></li>
                            <?php } ?>
                            <?php if(in_array('domain',array_column($platforms,'platform'))) { ?>
                                <li><a href="<?php echo base_url().'domains' ?>"><?php echo $this->lang->line('lang_header_main_sub_domains'); ?></a></li>
                            <?php } ?>
                            <?php if(in_array('app',array_column($platforms,'platform'))) { ?>
                                <li><a href="<?php echo base_url().'apps' ?>"><?php echo $this->lang->line('lang_header_main_sub_apps'); ?></a></li>
                            <?php } ?>
							<li><a href="<?php echo base_url() ?>auctions"><span><?php echo $this->lang->line('lang_header_main_auction'); ?></span></a></li>
							<li><a href="<?php echo base_url() ?>offers"><span><?php echo $this->lang->line('lang_header_main_offer'); ?></span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3><?php echo $this->lang->line('lang_header_footer_header_4'); ?></h3>
						<ul>
							<li><a href="https://resources.startupdeals.net/blog/"><span><?php echo $this->lang->line('lang_header_footer_header_blog'); ?></span></a></li>
							<li><a href="https://resources.startupdeals.net/contact/"><span><?php echo $this->lang->line('lang_header_main_contact'); ?></span></a></li>
							<li><a href="https://resources.startupdeals.net/privacy-policy/"><span><?php echo $this->lang->line('lang_header_footer_header_pp'); ?></span></a></li>
							<li><a href="https://resources.startupdeals.net/terms-of-service/"><span><?php echo $this->lang->line('lang_header_footer_header_tos'); ?></span></a></li>
						</ul>
					</div>
				</div>

				<?php if(empty($this->session->userdata('user_id'))){ ?>
				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3><?php echo $this->lang->line('lang_header_footer_header_5'); ?></h3>
						<ul>
							<li><a href="<?php echo base_url()?>login"><span><?php echo $this->lang->line('lang_header_main_login'); ?></span></a></li>
							<li><a href="<?php echo base_url()?>signup"><span><?php echo $this->lang->line('lang_header_main_signup'); ?></span></a></li>
						</ul>
					</div>
				</div>
				<?php } else { ?>
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3><?php echo $this->lang->line('lang_header_footer_header_5'); ?></h3>
						<ul>
							<li><a href="<?php echo base_url()?>user"><span><?= $this->lang->line('lang_sidebar_dashboard'); ?></span></a></li>
							<li><a href="<?php echo base_url()?>user/user_settings"><span><?= $this->lang->line('lang_sidebar_my_account'); ?></span></a></li>
							<li><a href="<?php echo base_url()?>user/change_password"><span><?= $this->lang->line('lang_sidebar_change_password'); ?></span></a></li>
						</ul>
					</div>
				</div>
				<?php } ?>

				<!-- Newsletter -->
				<div class="col-xl-4 col-lg-4 col-md-12">
					<h3><i class="icon-feather-mail"></i> <?php echo $this->lang->line('lang_header_footer_subscribe'); ?></h3>
					<div id="validation"></div>
					<span id="loadingsub" align="center centerButtons" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
					<p><?php echo $this->lang->line('lang_header_footer_subscribe_sub'); ?></p>
					<form method="post" enctype="multipart/form-data" class="newsletter">
						<input type="text" id="subscribe_email" name="subscribe_email" placeholder="<?= $this->lang->line('lang_subscribe_placeholder'); ?>">
						<button type="submit"><i class="fas fa-arrow-<?= ($l_format === 'rtl') ? 'left' : 'right'; ?>"></i></button>
						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Middle Section / End -->
	
	<!-- Footer Copyrights -->
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					&copy; <?php echo date('Y');?><strong><a href="<?php echo base_url();?>" target="_blank"><?php echo $this->lang->line('site_name'); ?> </a></strong> <?php if($settings[0]['footer_credits'] === '1') { ?> | Powered By<a href="https://www.onlinetoolhub.com" target="_blank"> Onlinetoolhub</a>. <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Copyrights / End -->

</div>
<!-- Footer / End -->	

