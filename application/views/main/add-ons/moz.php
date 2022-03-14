<!--Moz Analytics---->
<?php if(!empty($mozAnalytics)) { ?>
<div class="content-body margin-bottom-20">
	<div class="row row-sm">
		<div class="col-md-12 col-lg-12 col-xl-6 mg-t-15 margin-top-20 mg-xl-t-0">
			<div class="card card-hover card-analytics-two">
				<div class="card-header bg-transparent">
					<label class="tx-medium tx-14 tx-color-01 mg-b-2"><b><?= $this->lang->line('lang_moz_title') ?> </b> </label>
					<nav class="nav nav-card-icon">
						<a href=""><i data-feather="refresh-ccw"></i></a>
						<a href=""><i data-feather="printer"></i></a>
						<a href=""><i data-feather="more-horizontal"></i></a>
					</nav>
				</div><!-- card-header -->
				<div class="card-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<div class="list-group-icon bg-orange tx-white"><i class="fa fa-line-chart"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_page_authority') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->page_authority)) echo number_format($mozAnalytics->results[0]->page_authority); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-primary tx-white"><i class="fa fa-pagelines"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_domain_authority') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->domain_authority)) echo number_format($mozAnalytics->results[0]->domain_authority); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-danger tx-white"><i class="fa fa-check-square"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_spam_score') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->spam_score) && $mozAnalytics->results[0]->spam_score !== -1) echo number_format($mozAnalytics->results[0]->spam_score); else echo 'N/A'; ?></div>
							<div class="list-rate tx-danger"><i class="icon fa fa-arrow-down"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-blue tx-white"><i class="fa fa-google"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_crawled_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->pages_crawled_from_root_domain)) echo number_format($mozAnalytics->results[0]->pages_crawled_from_root_domain); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-green tx-white"><i class="fa fa-link"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_links_prospensity') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->link_propensity)) echo number_format($mozAnalytics->results[0]->link_propensity,4); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-indigo tx-white"><i class="fa fa-tty"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_subdomain_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->pages_to_subdomain)) echo number_format($mozAnalytics->results[0]->pages_to_subdomain); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
					</ul>
				</div>
			</div><!-- card -->
		</div><!-- col -->

		<div class="col-md-12 col-lg-12 col-xl-6 mg-t-15 margin-top-20 mg-xl-t-0">
			<div class="card card-hover card-analytics-two">

				<div class="card-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<div class="list-group-icon bg-orange tx-white"><i class="fa fa-anchor"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_backlinks') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->root_domains_to_root_domain)) echo number_format($mozAnalytics->results[0]->root_domains_to_root_domain); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-primary tx-white"><i class="fa fa-keyboard-o"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->pages_from_root_domain)) echo number_format($mozAnalytics->results[0]->pages_from_root_domain); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-danger tx-white"><i class="fa fa-dot-circle-o"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_follow_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->nofollow_root_domains_to_page)) echo number_format($mozAnalytics->results[0]->nofollow_root_domains_to_page); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-blue tx-white"><i class="fa fa-calendar-o"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz__unqiue_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->pages_to_root_domain)) echo ($mozAnalytics->results[0]->pages_to_root_domain); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-green tx-white"><i class="fa fa-trash"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_deleted_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->deleted_pages_to_page)) echo number_format($mozAnalytics->results[0]->deleted_pages_to_page); ?></div>
							<div class="list-rate tx-danger"><i class="icon fa fa-arrow-down"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-orange tx-white"><i class="fa fa-retweet"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_redirects_to_domains') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->redirect_pages_to_root_domain)) echo number_format($mozAnalytics->results[0]->redirect_pages_to_root_domain); ?></div>
							<div class="list-rate tx-success"><i class="icon fa fa-arrow-up"></i></div>
						</li>
						<li class="list-group-item">
							<div class="list-group-icon bg-indigo tx-white"><i class="fa fa-repeat"></i></div>
							<div class="list-body">
								<h6><?= $this->lang->line('lang_moz_no_follow_pages') ?></h6>
								<span><?= $this->lang->line('lang_moz_by_moz') ?></span>
							</div>
							<div class="list-visit"><?php if(isset($mozAnalytics->results[0]->nofollow_pages_from_root_domain)) echo number_format($mozAnalytics->results[0]->nofollow_pages_from_root_domain); ?></div>
							<div class="list-rate tx-danger"><i class="icon fa fa-arrow-down"></i></div>
						</li>
					</ul>
				</div>
			</div><!-- card -->
		</div><!-- col -->

	</div>
</div>
<?php } ?>
