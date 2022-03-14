<!DOCTYPE html>
<html dir="<?= !empty($l_format) ? $l_format : 'ltr'; ?>" lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php echo $this->lang->line('site_accounts_keywords'); ?>"/>
<meta name="description" content="<?php echo $this->lang->line('site_accounts_metadescription'); ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo $this->lang->line('site_accounts'); ?> | <?php echo $this->lang->line('site_name'); ?></title>
<meta name="og:title" content="<?php echo $this->lang->line('site_accounts'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo $this->lang->line('site_accounts'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:description" content="<?php echo $this->lang->line('site_accounts_metadescription'); ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/header'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>

<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php echo $this->lang->line('lang_bred_accounts_page_main'); ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php echo $this->lang->line('lang_bred_accounts_page_sub'); ?></h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Page Content-->
<div class="container">

    <!---Section Title--->
    <div class="container-fluid">
    <div class="jumbotron">
        <h2 class="slippa-section-title dark"><?php echo $this->lang->line('lang_accounts_category_h2'); ?></h2>
        <p class="lead rtl-right"><?php echo $this->lang->line('lang_accounts_category_p'); ?></p>
        <div class="header__form-networks margin-top-20">
            <?php foreach ($platform_list as $key ) { 
                if($key['platfrom_domain'] === $this->session->userdata('platfrom')){ ?>
                    <a class="active" href="<?= $key['platfrom_domain']; ?>" ><?= $key['platfrom']; ?> </a>
                <?php } else { ?>
                    <a href="<?= base_url().'accounts/'.$key['platfrom_domain'].'/0' ?>" ><?= $key['platfrom']; ?> </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    </div>
    <!---/Section Title--->

    <!-- Social Accounts Container -->
    <div id="social-accounts" class="container">

        <div class="row">

            <?php foreach ($featuredAccounts as $Accounts) { ?>

                <div class="col-md-3 margin-top-20">
                    <div class="account-item">
                        <div class="post__image">
                            <img src="<?php echo base_url().$Accounts['listing_option'].'/'.$Accounts['listing_type'].'/'.$Accounts['id'];  ?>"><img src="<?php if(isset($Accounts['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$Accounts['website_thumbnail'];  ?>">
                            <div class="post__more"><a href="<?php echo base_url().$Accounts['listing_option'].'/'.$Accounts['listing_type'].'/'.$Accounts['id'];  ?>"><?= $this->lang->line('lang_showmore') ?></a></div>
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

    <!-- Pagination -->
    <div class="clearfix"></div>
    <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
        <nav class="pagination paginationAccount">
            <ul>
                <?php if(!empty($links)) if(isset($links)) { echo $links; }?>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <!-- Pagination / End -->

    </div>

    <!-- /Social Accounts Container -->


    <!-- ad-section --> 
    <!-------------------------------------------------------------------------------------------------------------->
    <?php if(!empty($ads[0]['webpage_banner_720x90'])) { ?>                 
        <div class="ad-section text-center margin-bottom-25">
            <?php print_r($ads[0]['webpage_banner_720x90']); ?>
        </div>
    <?php } ?>
    <!--------------------------------------------------------------------------------------------------------------->
    <!-- ad-section / End-->

   
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footer'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</div>
<!-- Wrapper / End -->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>