<!-- ESCROW TRANSACTIONS --->
<div class="withdraw-card__header card-header">
    <h3 class="withdraw-card__header-title card-title">ALL ESCROW TRANSACTIONS | <strong>PAGE : <?php if(!empty($transactions['page'])) echo $transactions['page']; ?> | TOTAL PAGES : <?php if(!empty($transactions['page_count'])) echo $transactions['page_count']; ?></strong></h3> 
    <?php if(!empty($transactions['page']) && intval($transactions['page']) > 1) {  ?>
    <a class="withdraw-card__header-link prevescrow" data-count='<?php if(!empty($transactions['page_count'])) echo $transactions['page_count']; ?>' data-page='<?php if(!empty($transactions['page'])) echo $transactions['page']; ?>' href="#">← Back</a>
    <?php } ?>
    <?php if(!empty($transactions['page_count']) && intval($transactions['page_count']) > 1 && intval($transactions['page_count']) !== intval($transactions['page'])) {  ?>
    <a class="withdraw-card__header-link nextescrow" data-count='<?php if(!empty($transactions['page_count'])) echo $transactions['page_count']; ?>' data-page='<?php if(!empty($transactions['page'])) echo $transactions['page']; ?>' href="#">Next →</a>
    <?php } ?>
</div>


<?php if(!empty($transactions['transactions'])) { foreach ($transactions['transactions'] as $transaction) { ?>
   
    <ul class="withdraw-list list-group list-group-flush">
    <!----Item ----->
      <a href="<?php echo base_url().'common/view_escrow/'.$transaction['id']; ?>" target="_blank">
        <li class="withdraw-list-item list-group-item">

        <div class="withdraw-list-item__date">
          <span class="withdraw-list-item__date-day"><?php if(isset($transaction['creation_date'])) echo date("d", strtotime($transaction['creation_date'])); ?></span>
          <span class="withdraw-list-item__date-month"><b><?php if(isset($transaction['creation_date'])) echo date("M", strtotime($transaction['creation_date'])); ?></b></span>
        </div>

        <div class="withdraw-list-item__text">
          <h4 class="withdraw-list-item__text-title"><b>#<?php if(isset($transaction['id'])) echo $transaction['id'] ; ?> </b></h4>
          <p class="withdraw-list-item__text-description"><b><?php if(isset($transaction['description'])) echo $transaction['description']; ?></b></p>
          <p><?php foreach ($transaction['parties'] as $parties) { if($parties['role'] === 'seller') echo '<strong> | seller : </strong>'.$parties['customer']; else if($parties['role'] === 'buyer') echo '<strong> buyer : </strong>'.$parties['customer']; else if($parties['role'] === 'broker') echo '<strong> | broker : </strong>'.$parties['customer'];} ?></p>
        </div>

        <div class="withdraw-list-item__fee">
          <span class="withdraw-list-item__fee-delta">+<?php if(isset($transaction['items'][0]['schedule'][0]['amount'])) echo number_format(floatval($transaction['items'][0]['schedule'][0]['amount'])); ?></span>
          <span class="withdraw-list-item__fee-currency"><?php if(!empty($transaction['currency'])) echo strtoupper($transaction['currency']); else echo 'USD'; ?></span>
          <?php if(!empty($transaction['items'])) { if(!$transaction['items'][0]['status']['accepted']) {?>
          <span class="badge badge-warning">On Going</span>
          <?php } else if($transaction['items'][0]['status']['accepted']) { ?>
          <span class="badge badge-success">Completed</span>
          <?php } else { ?>
          <span class="badge badge-danger">Not Clear</span>
          <?php } } else { ?> <span class="badge badge-danger">Something is wrong</span> <?php }?>
        </div>
                  
        </li>
      </a>
      <!----/Item ----->
    </ul>
<?php } } else { ?>
    <ul class="withdraw-list list-group list-group-flush">
    <!----Item ----->
      <li class="withdraw-list-item list-group-item">
        No results were found
      </li>
    </ul>
<?php } ?>
<!--/ ESCROW TRANSACTIONS --->