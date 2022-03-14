<!--Google Analytics---->
<?php if(!empty($domainStatics)) { ?>
	<div class="content-body">
		<div class="row row-sm">

			<div class="col-xl-12">
				<div class="card card-hover card-analytics-one">
					<div class="card-body">
						<div class="row row-sm">
							<div class="col-sm-8 col-md-8">
								<label class="tx-medium tx-14 tx-color-01 mg-b-2"><b><?= $this->lang->line('lang_ana_google_title') ?> </b> </label>
								<p class="tx-12 tx-color-03 mg-b-20"><?= $this->lang->line('lang_ana_realtime_reports_title') ?> <b></b></p>
								<div class="chart-wrapper" style="width: 100%; height: 100%;">
									<canvas id="flotChart" class="flot-chart"></canvas>
								</div>
							</div>

							<div class="col-sm-4 col-md-4 mg-t-15 mg-sm-t-0">
								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_bounce_rate') ?></label>
								<div class="d-flex align-items-baseline mg-b-5">
									<h2 class="card-value mg-b-0"><?php if(isset($domainStatics[0][6])) echo number_format($domainStatics[0][6],2); ?><span>%</span></h2>
								</div>
								<div class="progress progress-value">
									<div class="progress-bar wd-75p" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<p class="card-value-desc"><?= $this->lang->line('lang_ana_bounce_rate_dsc') ?></p>

								<hr class="mg-y-10 op-0">

								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_organic_search') ?></label>
								<div class="d-flex align-items-baseline mg-b-5">
									<h2 class="card-value mg-b-0"><span></span></h2><?php if(isset($domainStatics[0][5])) echo number_format($domainStatics[0][5]); ?></h2>
								</div>
								<div class="progress progress-value">
									<div class="progress-bar bg-brand-02 wd-30p" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<p class="card-value-desc"><?= $this->lang->line('lang_ana_organic_search_desc') ?></p>

							</div><!-- col -->
						</div><!-- row -->
					</div>
					<div class="card-footer bg-transparent">
						<div class="row no-gutters">
							<div class="col-sm-2 col-sm">
								<div class="d-flex align-items-baseline mg-b-5">
									<h4 class="tx-numeric tx-normal"><span></span><?php if(isset($domainStatics[0][0])) echo $domainStatics[0][0]; ?></h4>
								</div>
								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_unique_visitors') ?></label>
							</div><!-- col -->
							<div class="col-sm-2 col-sm">
								<div class="d-flex align-items-baseline mg-b-5">
									<h4 class="tx-numeric tx-normal"><?php if(isset($domainStatics[0][1])) echo $domainStatics[0][1]; ?></h4>
								</div>
								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_page_views') ?></label>
							</div><!-- col -->
							<div class="col-sm-2 col-sm mg-t-15 mg-sm-t-0">
								<div class="d-flex align-items-baseline mg-b-5">
									<h4 class="tx-numeric tx-normal"><?php if(isset($domainStatics[0][7])) echo $domainStatics[0][7]; ?></h4>
								</div>
								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_new_users') ?></label>
							</div><!-- col -->
							<div class="col-sm-2 col-sm mg-t-15 mg-sm-t-0">
								<div class="d-flex align-items-baseline mg-b-5">
									<h4 class="tx-numeric tx-normal"><?php if(isset($domainStatics[0][4])) echo number_format($domainStatics[0][4],2); ?>%</h4>
								</div>
								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_avg_sessions') ?></label>
							</div><!-- col -->
							<div class="col-sm-2 col-sm mg-t-15 mg-sm-t-0">
								<div class="d-flex align-items-baseline mg-b-5">
									<h4 class="tx-numeric tx-normal"><span>$</span><?php if(isset($domainStatics[0][3])) echo $domainStatics[0][3]; ?></h4>
								</div>
								<label class="content-label content-label-xs"><?= $this->lang->line('lang_ana_revenue') ?></label>
							</div><!-- col -->
						</div><!-- row -->
					</div><!-- card-footer -->
				</div><!-- card -->
			</div><!-- col -->

		</div>
	</div>

<?php } ?>

<?php if(!empty($adsense)) { ?>

	<div class="col-md-12 col-lg-12 margin-top-20 margin-bottom-40">
		<div class="card card-hover card-chart-two">
			<div class="card-header bg-transparent bd-b-0 margin-left-40">
				<label class="tx-medium tx-14 tx-color-01 mg-b-2"><b><?= $this->lang->line('lang_ana_google_adsense') ?> </b> </label>
				<p class="tx-12 tx-color-03 mg-b-20"><?= $this->lang->line('lang_ana_google_adsense_desc') ?></b></p>
				<p class="card-value-label"><?= $this->lang->line('lang_ana_google_adsense_earnings') ?></p>
				<h1 class="card-value"><?php if(isset($adsense[0][0])) echo number_format($adsense[0][0],2); ?><span>usd</span></h1>
				<!--<p class="card-value-label">Your Earnings</p>
				<p class="tx-color-03">Adsense earnings over the last 6 Months</p>-->
				<p class="tx-11 tx-gray-500 margin-bottom-20"><?= $this->lang->line('lang_ana_google_adsense_desc_2') ?></p>
			</div><!-- card-header -->

			<nav class="nav nav-card-icon">
				<a href=""><i data-feather="refresh-ccw"></i></a>
				<a href=""><i data-feather="printer"></i></a>
				<a href=""><i data-feather="more-horizontal"></i></a>
			</nav>

			<div class="card-body">
				<div class="chart-wrapper">
					<canvas id="AdsenseChart" class="flot-chart"></canvas>
				</div><!-- chart-wrapper -->
			</div>
		</div><!-- card -->
	</div><!-- col -->

	<div class="row margin-top-20 margin-bottom-20">

		<div class="col-sm-6 col-md-6 mg-t-15">
			<div class="card card-hover card-chart-one">
				<div class="card-header bg-transparent pd-b-0 bd-b-0">
					<h6 class="card-title mg-b-0"><b><?= $this->lang->line('lang_ana_google_total_earnings') ?></b></h6>
					<nav class="nav">
						<a href="" class="link-gray-500"><i data-feather="help-circle" class="svg-16"></i></a>
						<a href="" class="link-gray-500"><i data-feather="more-vertical" class="svg-16"></i></a>
					</nav>
				</div>
				<div class="card-body pd-t-0">
					<div>
						<h1 class="card-value" style="letter-spacing: 0.5px;"><span>$</span><?php if(isset($adsenseTotal[0][0])) echo number_format($adsenseTotal[0][0],2); ?></h1>
						<div class="d-flex align-items-center tx-teal">
							<i data-feather="arrow-up-circle" class="svg-12 fill-teal"></i>
							<span class="mg-l-5 tx-numeric tx-11"><?= $this->lang->line('lang_ana_google_ctr') ?> <?php if(isset($adsenseTotal[0][3])) echo number_format($adsenseTotal[0][3],2); ?></span>
						</div>
					</div>
					<div class="chart-wrapper">
						<canvas id="adsenseEarnings" class="flot-chart"></canvas>
					</div>
				</div><!-- card-body -->
			</div><!-- card -->
		</div><!-- col -->
		<div class="col-sm-6 col-md-6 mg-t-15 mg-sm-t-20">
			<div class="card card-hover card-chart-one">
				<div class="card-header bg-transparent pd-t-15 pd-l-20 pd-r-15 pd-b-0 bd-b-0">
					<h6 class="card-title mg-b-0"><b><?= $this->lang->line('lang_ana_google_adsense_impres') ?></b></h6>
					<nav class="nav">
						<a href="" class="link-gray-500"><i data-feather="help-circle" class="svg-16"></i></a>
						<a href="" class="link-gray-500"><i data-feather="more-vertical" class="svg-16"></i></a>
					</nav>
				</div>
				<div class="card-body pd-t-0">
					<div>
						<h1 class="card-value" style="letter-spacing: 0.5px;"><?php if(isset($adsenseTotal[0][1])) echo number_format($adsenseTotal[0][1]); ?></h1>
						<div class="d-flex align-items-center tx-danger">
							<i data-feather="arrow-up-circle" class="svg-12 fill-pink"></i>
							<span class="mg-l-5 tx-numeric tx-11"><?= $this->lang->line('lang_ana_google_adsense_ctr_perc') ?> <?php if(isset($adsenseTotal[0][4])) echo number_format($adsenseTotal[0][4],2); ?>%</span>
						</div>
					</div>
					<div class="chart-wrapper">
						<canvas id="adsenseImpres" class="flot-chart"></canvas>
					</div>
				</div><!-- card-body -->
			</div><!-- card -->
		</div><!-- col -->

	</div>

	<?php } ?>