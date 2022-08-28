<section class="home">
<!--Search form-->
 <div class="container" id="portfolio_form">
   <form class="py-0" action="#" method="post">
     <h2 class="text-center p-2">My Portfolio</h2><hr>
     <div class="m-auto col-md-6">
       <input list="select_coin" class="form-control" name="select_coin" value="" placeholder="Search your Asset...">
       <datalist class="" id="select_coin">
         <?php
          foreach ($Trade_history->getCoinName('coin_details','coin_name') as $coin_n){
            ?><option value="<?=$coin_n['coin_name'].'('.$coin_n['short_name'].')';?>"><?php
          }
          ?>
       </datalist>
       <select class="form-control" name="select_coin" style="width:100%;">
         <option value="">Select Coin</option>
         <?php
          foreach ($Trade_history->getCoinName('coin_details','coin_name') as $coin_n){
            ?><option value="<?=$coin_n['id'];?>"><?=$coin_n['coin_name'].'('.$coin_n['short_name'].')';?></option><?php
          }
          ?>
       </select>
       <button type="submit" class="btn btn-primary form-control" name="search_coin_portfolio" style="width:150px;letter-spacing:2px;">Search</button>
     </div>
   </form>
 </div>
 <!--Table data-->
 <?php
 if (isset($_POST['search_coin_portfolio'])) {
   // get Trade details.
   $asset_id = ((isset($_POST['select_coin']) && $_POST['select_coin'] != '')?sanitize($_POST['select_coin']):'');
   if (empty($asset_id)) {
     echo display_error('Please select coin!!');
   }
   // get Asset details.
     $asset_details = $Trade_history->getAssetName('coin_details',$asset_id);
   // get Asset details.
     foreach ($asset_details as $value) {
       $asset_name = $value['coin_name'];
       $asset_short_name = $value['short_name'];
     }
  ?>
 <div class="container" id="portfolio_table">
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
         <th>Exchange</th>
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
           $exg_id = $trade_details['exchange_id'];
           $i++;
           // get Exchange details.
             foreach ($Trade_history->getAssetName('exchange_details',$exg_id) as $value) {
               $exg_name = $value['exchange_name'];
             }
           ?>
           <tr class="<?=(($trade_details['qty_buy'] > 0)?'bg-info':'bg-danger');?>">
             <td><?=$i;?></td>
             <td><?=((isset($trade_details['qty_buy']))?qty($trade_details['qty_buy']):'-');?></td>
             <td><?=((isset($trade_details['qty_sell']))?qty($trade_details['qty_sell']):'-');?></td>
             <td><?=money($trade_details['rate']);?></td>
             <td><?=((isset($trade_details['buy_amt']))?money($trade_details['buy_amt']):'-');?></td>
             <td><?=((isset($trade_details['sell_amt']))?money($trade_details['sell_amt']):'-');?></td>
             <td><?=$exg_name;?></td>
             <td><?=pretty_date($trade_details['date']);?></td>
           </tr><?php
         }
        ?>
     </tbody>
     <tfoot>
       <tr>
         <td>Total</td>
         <td><?=qty($total_buy_qty);?></td>
         <td><?=qty($total_sell_sell);?></td>
         <td><?=qty($total_buy_qty - $total_sell_sell);?></td>
         <td><?=money($total_buy);?></td>
         <td><?=money($total_sell);?></td>
       </tr>
     </tfoot>
   </table>
 </div>
<?php } ?>
</section>
