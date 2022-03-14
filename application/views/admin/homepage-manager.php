<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Homepage Manager  | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--/Admin Page Meta Tags-->

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
<?php $this->load->view('admin/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Homepage Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Homepage Manager</a></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<div class="col-12 grid-margin">
              			<div class="card">
                  		<div class="card-body">
                      	<h4 class="card-title">HOMEPAGE MODULES </h4>
                      	<form class="forms-sample">
                        <!--/Plugins Table -->
                        <div id="table_plugins_div" class="table-responsive">
                        	<table id="table_plugins" class="table table-striped table-hover responsive">
                          	<tbody>

                            <!-- Module 1 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>SOLD DOMAINS CROUSEL</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                  	<?php if($homepage[0]['sold-domains'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="sold-domains" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                  	<?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="sold-domains" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                  	<?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 1 -->

                            <!-- Module 2 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>APPS CROUSEL</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['apps'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="apps" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="apps" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 2 -->

                            <!-- Module 3 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>FEATURED DOMAINS CROUSEL</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['featured-domains-slider'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="featured-domains-slider" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="featured-domains-slider" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 3 -->

                            <!-- Module 4 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>POPULAR CATEGORIES</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['popular-categories'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="popular-categories" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="popular-categories" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 4 -->

                            <!-- Module 5 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE AUCTION TABLE</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['auction-table'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="auction-table" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="auction-table" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 5 -->

                            <!-- Module 6 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE SPONSORED CROUSEL</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['sponsored-ads'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="sponsored-ads" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="sponsored-ads" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 6 -->

                            <!-- Module 7 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE HOW IT WORKS SECTION</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['how-it-works'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="how-it-works" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="how-it-works" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 7 -->

                            <!-- Module 8 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE ENDING SOON CROUSEL</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['ending-soon'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="ending-soon" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="ending-soon" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 8 -->

                            <!-- Module 9 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE TRENDING CROUSELS</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['trending-listings'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="trending-listings" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="trending-listings" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 9 -->

                            <!-- Module 10 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE WHY US INFO</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['why-us'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="why-us" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="why-us" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 10 -->

                            <!-- Module 11 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE DOMAIN LISTINGS</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['domains-columns'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="domains-columns" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="domains-columns" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 11 -->

                            <!-- Module 12 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE INFO BOX</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['info-box'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="info-box" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="info-box" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 12 -->

                            <!-- Module 13 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE BLOG CAROUSEL</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['blog-carousel'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="blog-carousel" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="blog-carousel" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 13 -->

                            <!-- Module 14 -->
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <p class="text_action">
                                      <span><strong>HOMEPAGE SOCIAL ACCOUNTS</strong></span>
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="col-sm-5">
                                    <?php if($homepage[0]['social_accounts'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active homepage_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid="social_accounts" data-actkey='0'  >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-toggle homepage_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid="social_accounts" data-actkey='1' >
                                      <div class="handle"></div>
                                    </button>
                                    <?php } ?>
                                </div>
                            </td>
                              
                            </tr>
                            <!-- /Module 14 -->


                        	</tbody>
                        	</table>
                        	</div>
                        	<!---/Plugins Table -->
                    	</form>
                  		</div>
                		</div>
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
<? if(DEMO_MODE) { 
    $this->load->view('admin/includes/disabled');
} ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>