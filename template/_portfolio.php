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
            ?><option value="<?=$coin_n['coin_name'];?>"><?=$coin_n['coin_name'].'('.$coin_n['short_name'].')';?></option><?php
          }
          ?>
       </datalist>
       <button type="submit" class="btn btn-primary form-control" name="search_coin_portfolio" style="width:150px;letter-spacing:2px;">Search</button>
     </div>
   </form>
 </div>
 <!--Table data-->
 <?php
 if (isset($_POST['search_coin_portfolio'])) {
   // get Trade details.
   $asset_name = ((isset($_POST['select_coin']) && $_POST['select_coin'] != '')?sanitize($_POST['select_coin']):'');
   // get Asset id.
     foreach ($Trade_history->getAssetDetails('coin_details',$asset_name) as $value) {
       $asset_id = $value['id'];
       $asset_name = $value['coin_name'];
       $asset_short_name = $value['short_name'];
     }
   if (empty($asset_id)) {
     echo display_error('Please select your Asset!!');
   }else {
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
         <td><?=money($total_sell - $total_buy);?></td>
       </tr>
     </tfoot>
   </table>
 </div>
<?php
 }
}
?>
</section>
