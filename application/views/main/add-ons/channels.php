<!-- Social Accounts Container -->

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



