
<div class="content with-padding padding-bottom-10">
	<div class="row centerButtons">
		<?php if(!empty($options)) { 
			foreach ($options as $option) { ?>
				<div class="col-xl-4">
					<div class="submit-field item">
						<input id="website_1_<?php echo $option['radio']; ?>" type="radio" name="website_1_group_2" value="<?php echo $option['radio']; ?>" class="required" <?= ($listing_data[0]['listing_option'] === $option['platform']) ? 'checked=""' : '' ; ?>">
						<label for="website_1_<?php echo $option['radio']; ?>"><img src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $option['icon']; ?>" alt=""><strong><?= $this->lang->line($option['name']) ; ?></strong><?= $this->lang->line($option['platform'].'_desc'); ?></label>
					</div>
				</div>
			<?php } } else {echo $this->lang->line('lang_c_select_sell_options');}   ?>
			
		</div>

		<div id="Sell-Auction-Website" style="<?= ($listing_data[0]['listing_option'] === 'auction') ? '' : 'display:none' ?>" class="row">

			<div class="col-xl-4">
				<div class="submit-field">
					<h5><?= $this->lang->line('lang_c_starting_price') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
					<input type="text" id="website_startingprice" name="website_startingprice" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)' value="<?= ($listing_data[0]['website_startingprice']) ?>">
				</div>
			</div>

			<div class="col-xl-4">
				<div class="submit-field">
					<h5><?= $this->lang->line('lang_c_reserved') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
					<input type="text" id="website_reserveprice" name="website_reserveprice" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)' value="<?= ($listing_data[0]['website_reserveprice']) ?>"><small id="reservredPriceWebsite" class="text-danger"></small>
				</div>
			</div>

			<div class="col-xl-4">
				<div class="submit-field">
					<h5><?= $this->lang->line('lang_c_buy_it_now') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
					<input type="text" id="website_buynowpriceauc" name="website_buynowprice" class=" form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)' value="<?= ($listing_data[0]['website_buynowprice']) ?>"><small class="text-info"> <?= $this->lang->line('lang_c_empty_disable') ?></small>
				</div>
			</div>
			
		</div>


		<div id="Sell-Classified-Website" style="<?= ($listing_data[0]['listing_option'] === 'classified') ? '' : 'display:none' ?>" class="row">

			<div class="col-xl-4">
				<div class="submit-field">
					<h5><?= $this->lang->line('lang_c_minimum_offer') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
					<input type="text" id="website_minimumoffer" name="website_minimumoffer" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)' value="<?= ($listing_data[0]['website_minimumoffer']) ?>">
				</div>
			</div>

			<div class="col-xl-4">
				<div class="submit-field">
					<h5><?= $this->lang->line('lang_c_buy_now') ?> (<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>)</h5>
					<input type="text" id="website_buynowpriceclas" name="website_buynowprice" class="form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)' value="<?= ($listing_data[0]['website_buynowprice']) ?>"><small class="text-info"> <?= $this->lang->line('lang_c_empty_disable') ?></small>
				</div>
			</div>
			
		</div>

	</div>