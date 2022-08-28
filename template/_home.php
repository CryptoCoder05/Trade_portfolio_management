<?php
if (isset($_GET['asset_id']) && isset($_GET['exg_id'])) {
// get Asset and exchange id.
  $asset_id = ((isset($_GET['asset_id']) && $_GET['asset_id'] != '')?sanitize($_GET['asset_id']):'');
  $exg_id = ((isset($_GET['exg_id']) && $_GET['exg_id'] != '')?sanitize($_GET['exg_id']):'');
// get Asset and exchange details.
  $asset_details = $Trade_history->getAssetName('coin_details',$asset_id);
  $exg_details = $Trade_history->getAssetName('exchange_details',$exg_id);
// get Asset details.
  foreach ($asset_details as $value) {
    $asset_name = $value['coin_name'];
    $asset_short_name = $value['short_name'];
  }
// get Exchange details.
  foreach ($exg_details as $value) {
    $exg_name = $value['exchange_name'];
  }
}

$error = array();
//Trade details
if (isset($_POST['buy']) || isset($_POST['sell'])) {
  $coin_id = ((isset($_POST['select_coin']) && $_POST['select_coin'] != '')?sanitize($_POST['select_coin']):'');
  if (empty($coin_id)) {
    $error[] = "You forgot to select your coin Name!";
  }

  $qty = ((isset($_POST['qty']) && $_POST['qty'] != '')?sanitize($_POST['qty']):'');
  if (empty($qty)) {
    $error[] = "You forgot to enter qty!";
  }

  $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
  if (empty($price)) {
    $error[] = "You forgot to enter Price!";
  }

  $total_amount = ((isset($_POST['total_amount']) && $_POST['total_amount'] != '')?sanitize($_POST['total_amount']):'');
  if (empty($total_amount)) {
    $error[] = "You forgot to enter Total Amount!";
  }

  $exchange_id = ((isset($_POST['select_exg']) && $_POST['select_exg'] != '')?sanitize($_POST['select_exg']):'');
  if (empty($exchange_id)) {
    $error[] = "You forgot to select Exchange Platform!";
  }

  // check errors...
  if (empty($error)) {
    if (isset($_POST['buy'])) {
      $query = "INSERT INTO `trade_history`(`coin_id`, `qty_buy`, `rate`, `buy_amt`, `exchange_id`)
                                    VALUES ('$coin_id','$qty','$price','$total_amount','$exchange_id')";
    }
    if (isset($_POST['sell'])) {
      $query = "INSERT INTO `trade_history`(`coin_id`, `qty_sell`, `rate`, `sell_amt`, `exchange_id`)
                                    VALUES ('$coin_id','$qty','$price','$total_amount','$exchange_id')";
    }

    $run_query = $con->query($query);

    if ($run_query === true) {
      echo display_success('Your work has been saved','index.php?asset_id='.$coin_id.'&exg_id='.$exchange_id);
    }else {
      echo display_error('Something wrong!');
    }

  }else {
    echo display_error('All fields are required!');
  }
}
?>
<section class="home">
 <div class="container" id="form_bg">
   <h2 class="text-center my-2">Trade Portfolio Management</h2><hr>
   <form class="form-row" action="#" method="post">
     <div class="col-md-3 py-2">
       <label class="sr-only" for="select_coin">Select Coin</label>
       <select class="form-control" name="select_coin">
         <option value="<?=((isset($_GET['asset_id']))?$asset_id:'');?>"><?=((isset($_GET['asset_id']))?$asset_short_name:'Select Asset');?></option>
         <?php
          foreach ($Trade_history->getCoinName('coin_details','coin_name') as $coin_n){
            ?><option value="<?=$coin_n['id'];?>"><?=$coin_n['short_name'];?></option><?php
          }
          ?>
       </select>
     </div>
     <div class="col-md-2 py-2">
       <label class="sr-only" for="qty">Quantity</label>
       <input type="text" class="form-control" name="qty" id="qty" value="" placeholder="Quantity" >
     </div>
     <div class="col-md-2 py-2">
       <label class="sr-only" for="price">Price</label>
       <input type="text" class="form-control" name="price" id="price" value="" placeholder="Price (INR)" >
     </div>
     <div class="col-md-3 py-2">
       <label class="sr-only" for="total_amount">Total Amount</label>
       <input type="text" class="form-control" name="total_amount" id="total_amount" value="" placeholder="Total Amount (INR)" >
     </div>
     <div class="col-md-2 py-2">
       <label class="sr-only" for="select_exg">Select Exchange</label>
       <select class="form-control" name="select_exg">
         <option value="<?=((isset($_GET['exg_id']))?$exg_id:'');?>"><?=((isset($_GET['exg_id']))?$exg_name:'Select Exchange');?></option>
         <?php
          foreach ($Trade_history->getCoinName('exchange_details','exchange_name') as $exchange_n){
            ?><option value="<?=$exchange_n['id'];?>"><?=$exchange_n['exchange_name'];?></option><?php
          }
          ?>
       </select>
     </div>
     <div class="form-group m-auto py-2">
       <button type="submit" class="btn btn-primary mr-2" name="buy" style="width:150px;letter-spacing:2px;">Buy</button>
       <button type="submit" class="btn btn-danger" name="sell" style="width:150px;letter-spacing:2px;">Sell</button>
     </div>
   </form>
 </div>
 <!--Table data-->
 <?php
 if (isset($_GET['asset_id'])) {
   if (empty($asset_id)) {
     echo display_error('Please Select Asset!!');
   }
  ?>
 <div class="container" id="buy_sell_table">
   <h2 class="text-center p-2" style="color:#fff;"><?=$asset_name;?></h2>
   <table class="table table-sm table-dark">
     <thead>
       <tr>
         <th>S.No</th>
         <th>Qty Buy</th>
         <th>Qty Sell</th>
         <th>Price</th>
         <th>Buy</th>
         <th>Sell</th>
         <th>Date</th>
       </tr>
     </thead>
     <tbody>
       <?php
         $i = 0;
         $total_buy_qty = 0;
         $total_sell_sell = 0;
         $total_buy = 0;
         $total_sell = 0;
         foreach ($Trade_history->getRecords($asset_id) as $trade_details) {
           $total_buy_qty += $trade_details['qty_buy'];
           $total_sell_sell += $trade_details['qty_sell'];
           $total_buy += $trade_details['buy_amt'];
           $total_sell += $trade_details['sell_amt'];
           $i++;
           ?>
           <tr class="<?=(($trade_details['qty_buy'] > 0)?'bg-info':'bg-danger');?>">
             <td><?=$i;?></td>
             <td><?=((isset($trade_details['qty_buy']))?$trade_details['qty_buy']:'-');?></td>
             <td><?=((isset($trade_details['qty_sell']))?$trade_details['qty_sell']:'-');?></td>
             <td><?=money($trade_details['rate']);?></td>
             <td><?=((isset($trade_details['buy_amt']))?money($trade_details['buy_amt']):'-');?></td>
             <td><?=((isset($trade_details['sell_amt']))?money($trade_details['sell_amt']):'-');?></td>
             <td><?=pretty_date($trade_details['date']);?></td>
           </tr><?php
         }
        ?>
     </tbody>
     <tfoot>
       <tr>
         <td>Total</td>
         <td><?=$total_buy_qty;?></td>
         <td><?=$total_sell_sell;?></td>
         <td></td>
         <td><?=money($total_buy);?></td>
         <td><?=money($total_sell);?></td>
       </tr>
     </tfoot>
   </table>
 </div>
<?php } ?>
</section>

<!--qty * price = Amount-->
<script type="text/javascript">
   $(document).ready(function () {
     output();
     $('#qty, #price').on('keydown keyup', function () {
       output();
     });
   });

   function output() {
     var input = $('#qty').val();
     var total = $('#price').val();
     var output = parseFloat(input).toFixed(4) * parseFloat(total).toFixed(4);
     var output = parseFloat(output).toFixed(4);
     if(!isNaN(output)){
       document.getElementById('total_amount').value = output;
     }
   }
</script>

<!--qty = Amount / price-->
<script type="text/javascript">
   $(document).ready(function () {
     output2();
     $('#total_amount, #price').on('keydown keyup', function () {
       output2();
     });
   });

   function output2() {
     var input = $('#total_amount').val();
     var total = $('#price').val();
     var output = parseFloat(input).toFixed(4) / parseFloat(total).toFixed(4);
     var output = parseFloat(output).toFixed(4);
     if(!isNaN(output)){
       document.getElementById('qty').value = output;
     }
   }
</script>
