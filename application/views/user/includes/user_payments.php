<div id="pay_listing" class="row" style="display: none;">

    <!-- Dashboard Box -->
    <div class="col-xl-12">

     <form id="payWrapper" method="POST" enctype="multipart/form-data" class="creditly-card-form agileinfo_form" action="<?php echo site_url("payments/proceedtoPayment")?>">

        <div class="question_title">
            <h3><?= $this->lang->line('lang_c_pay_start_selling') ?></h3>
        </div>


        <?php if(!empty($error)) {?>
           <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span><?php print_r($error); ?></span></div>
       <?php } ?>

       <!-- Payment Methods Accordion -->
       <?php if(!empty($payments)) { ?>
        <!-- Payment Methods Accordion -->

        <br>
        
        <div class="accordion" id="paymentMethods">

            <div class="row justify-content-center p-3">
                <div class="col-lg-8 payment-form dark">
                    
                    <div class="products checkout-summary">
                        <h3 class="title"><?= $this->lang->line('site_checkout_page') ?></h3>
                    </div>
                    
                </div>
            </div>

            <div id="payOptions" >
                <div id="paymentValidations"></div>
                <?php foreach ($payments as $key) { ?>

                    <!---- PAYMENT TABS ----->
                    <div class="card payment-tab payment-tab-active">

                        <div class="card-header">
                            <div class="payment-tab-trigger">
                                <input data-toggle="collapse" data-target="#<?= $key['paymentgateway_id'] ?>" type="radio" id="<?= $key['paymentgateway_id'] ?>" name="cardType" class="custom-control-input" value="<?= $key['paymentgateway_id'] ?>">
                                <label class="custom-control-label" for="<?= $key['paymentgateway_id'] ?>"><?= $key['description'] ? $key['description'] : $key['method'] ?></label>
                                <img class="payment-logo paypal" src="<?php if(!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="">
                            </div>
                        </div>

                        <div id="<?= $key['paymentgateway_id'] ?>" class="collapse" data-parent="#paymentMethods">
                            <div class="payment-tab-content">
                                <div class="card-body">
                                    <?php if($key['card_status'] === '0') { 

                                        if($key['email_only'] === '0') { ?>

                                            <p><?= $this->lang->line('blog_co_payment_redirect_part1') ?> <?= $key['method'] ?> <?= $this->lang->line('blog_co_payment_redirect_part2') ?></p>

                                        <?php } else { ?>

                                            <section >
                                                <div class="payment-tab-content <?= $key['paymentgateway_id'] ?>">

                                                    <div class="col-md-6">
                                                        <div class="card-label">
                                                            <input class="escrow_buyer_email" id="escrow_buyer_email" name="escrow_buyer_email" required type="email" placeholder="andrew@onlinetoolhub.com">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="owner_escrow" id="owner_escrow" value="<?php echo $seller_email ?>"/>

                                                </div>
                                            </section>
                                            <!---- / Escrow ----->
                                        <?php } ?>

                                    <?php } else { ?>

                                        <section class="creditly-wrapper">
                                            <div class="payment-tab-content <?= $key['paymentgateway_id'] ?>">
                                                <div class="row payment-form-row credit-card-wrapper">

                                                    <div class="col-md-6">
                                                        <div class="card-label">
                                                            <input class="nameOnCard" name="name" required type="text" placeholder="Cardholder Name">
                                                            <input type="hidden" name="txt_name" class="txt_name"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="card-label">
                                                            <input class="number credit-card-number form-control" type="text" name="number"
                                                            inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;"  onkeypress='validateInputNumbers(event)'>

                                                            <input type="hidden" name="txt_number" class="txt_number"/>
                                                            <input type="hidden" name="txt_security-code" class="txt_security-code"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="card-label">
                                                            <label class="control-label"><?= $this->lang->line('lang_c_expire_date') ?></label>
                                                            <input class="expiration-month-and-year form-control" type="text" name="expiration-month-and-year" placeholder="MM / YY"  onkeypress='validateInputNumbers(event)'>
                                                            <input type="hidden" name="txt_month" class="txt_month"/>
                                                            <input type="hidden" name="txt_year" class="txt_year"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="card-label">
                                                            <input class="security-code form-control"Â·inputmode="numeric"type="text" name="security-code"placeholder="&#149;&#149;&#149;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----/ PAYMENT TABS ----->

                <?php } ?>
            </div>

            <div id="freeOptions" class="card payment-tab payment-tab-active">

                <div class="card-header">
                    <div class="payment-tab-trigger">
                        <input data-toggle="collapse" data-target="#free_checkout" type="radio" id="free_checkout" name="cardType" class="custom-control-input" value="free_checkout" />
                        <label for="free_checkout"><?= $this->lang->line('lang_c_free_checkout') ?></label>
                        <img class="payment-logo paypal" src="https://i.imgur.com/ApBxkXU.png" alt="">
                    </div>
                </div>

                <div class="payment-tab-content">
                    <div class="card-body">
                        <p><?= $this->lang->line('lang_c_free_checkout_sub') ?></p>
                    </div>
                </div>

            </div>

        </div>

    <?php } ?>

    <input type="hidden" name="txt_payid" id="txt_payid">
    <input type="hidden" name="txt_payamount" id="txt_payamount">
    <input type="hidden" name="txt_listingid" id="txt_listingid" value="<?php if(!empty($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
    <input type="hidden" name="txt_sponsored_id" id="txt_sponsored_id">
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <input id="button_pay" name="button_pay" type="submit" class="button big ripple-effect margin-top-40 margin-bottom-65 submit" style="float: right; display: none;" value="Proceed Payment">


</form>

</div>
</div>

<script>checkoutlistingspage();</script>