<!-- Category Boxes  -->
<div class="section margin-top-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

                <!---Section Title--->
				<div class="row">
    				<div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
        				<h2 class="slippa-section-title dark">
            				<?php echo $this->lang->line('lang_social_title'); ?>
        				</h2>
        				<p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
            				<?php echo $this->lang->line('lang_social_title_sub'); ?>
        				</p>
    				</div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
				</div><!-- /.row -->
				<!-----Section Title--->

				<!-- Social Accounts Container -->
                <div class="container">

                <div class="row">

                	<?php foreach ($featuredAccounts as $Accounts) { ?>

					<div class="col-md-3 margin-top-20">
						<div class="account-item">
						<div class="post__image">
							<img src="<?php echo base_url().$Accounts['listing_option'].'/'.$Accounts['listing_type'].'/'.$Accounts['id'];  ?>"><img src="<?php if(isset($Accounts['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$Accounts['website_thumbnail'];  ?>">
							<div class="post__more"><a href="<?php echo base_url().$Accounts['listing_option'].'/'.$Accounts['listing_type'].'/'.$Accounts['id'];  ?>"><?= $this->lang->line('lang_showmore'); ?></a></div>
							<img src="<?php echo base_url().CATEGORY_IMAGES ?>/<?php if(isset($Accounts['platfrom_icon'])) echo strtolower($Accounts['platfrom_icon']); ?>" alt="<?php if(isset($Accounts['platfrom'])) echo strtolower($Accounts['platfrom']); ?>" data-toggle="tooltip" title="<?php if(isset($Accounts['platfrom'])) echo strtolower($Accounts['platfrom']); ?>" class="check-mark mobile">
						</div>

						<div class="post__content text-center">
							<div class="post__title" >
								<a href="<?php echo base_url().$Accounts['listing_option'].'/'.$Accounts['listing_type'].'/'.$Accounts['id'];  ?>" ><?= strtoupper($Accounts['website_BusinessName']);?></a>
							</div>
							<div class="post__type"><b><?= strtoupper($Accounts['extension']);?></b></div>
							<div class="post__price"><span><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?></span> <?php if(isset($Accounts['website_buynowprice'])) echo number_format(floatval($Accounts['website_buynowprice'])); else echo number_format(floatval($Accounts['website_buynowprice']));  ?>
							</div>
							<div class="post__data">
								<p><span><?php if(isset($Accounts['monthly_downloads'])) echo number_format(floatval($Accounts['monthly_downloads'])); else echo number_format(floatval($Accounts['monthly_downloads']));  ?></span> - <?= $this->lang->line('lang_btn_channel_followers'); ?>
								</p>
							</div>
							<form class="post__form">
								<button type="button" onclick="location.href='<?php echo base_url().'checkout/'.'buynow'.'/'.$Accounts['id']; ?>'" class="button ripple-effect move-on-hover full-width"><?= $this->lang->line('lang_btn_buy_channel'); ?></button>
							</form>
						</div>

						</div>
					</div>

					<?php } ?>
				
				</div>

				</div>
	
				<!-- /Social Accounts Container -->

			</div>
			
		</div>

		<div class="row  margin-top-30">
			<div class="col-12">
				<div class="text-center">
					<a href="<?php echo base_url() ?>accounts" class="slippa-btn slippa-outline-gray text-uppercase pill"> <i class="icofont-refresh slippa-mr-5"></i> <?php echo $this->lang->line('lang_btn_view_all'); ?></a>
				</div><!-- /.text-center -->
			</div><!-- /.col-12 -->
		</div><!-- /.row -->

	</div>

</div>
<!-- Category Boxes / End -->