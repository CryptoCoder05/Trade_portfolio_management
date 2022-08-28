<?php
$data = $Trade_history->getData('trade_history');
if (empty($data)) {
   include "template/_home.php";
}else {
 ?>
<section class="container-fluid p-3">
  <h4 class="text-center">Dashboard</hr><hr>
  <div class="row">
    <div class="col-md-6" id="donutchart" style="width: auto; height: 500px;"></div>
    <div class="col-md-6" id="piechart" style="width: auto; height: 500px;"></div>
  </div>
  <div class="row">
    <div class="col-md-12" id="columnchart_material" style="height: 500px;"></div>
  </div>
</section>

<!--Bargraph-->
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Cryptocurrency','Buy','Sell'],
      //graph data
      <?php
      $data = $Trade_history->getData('coin_details');
      foreach ($data as $value) {
        $coin_name = $value['short_name'];
        $coin_id = $value['id'];
        $buy_amt = 0;
        $sell_amt = 0;
        $report = $Trade_history->dashBoard($coin_id,'trade_history');
        foreach ($report as $rep_value) {
          $buy_amt += $rep_value['buy_amt'];
          $sell_amt += $rep_value['sell_amt'];
        }
        $profit = $sell_amt - $buy_amt;
        if ($buy_amt != 0) {
          echo "['$coin_name', $buy_amt, $sell_amt],";
        }
      }
      ?>
      //end of graph data
    ]);

    var options = {
      chart: {
        title: 'Portfolio Performance',
        subtitle: 'Buy and Sell: 2020-2021',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

<!--donutchart-->
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Buy/Sell', 'Amount'],
      //graph data
      <?php
      $data = $Trade_history->getData('trade_history');
      $buy_amt = 0;
      $sell_amt = 0;
      foreach ($data as $value) {
        $buy_amt += $value['buy_amt'];
        $sell_amt += $value['sell_amt'];
      }
      if ($buy_amt != 0) {
        echo "  ['Investment', $buy_amt],
                ['Withdraw',   $sell_amt],";
      }
      ?>
      //end of graph data
    ]);

    var options = {
      title: 'My Portfolio',
      pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
  }
</script>

<!--PieChart-->
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Asset', 'Available Qty'],
          //graph data
          <?php
          $data = $Trade_history->getData('coin_details');
          foreach ($data as $value) {
            $coin_name = $value['short_name'];
            $coin_id = $value['id'];
            $qty_buy = 0;
            $qty_sell = 0;
            $report = $Trade_history->dashBoard($coin_id,'trade_history');
            foreach ($report as $rep_value) {
              $qty_buy += $rep_value['qty_buy'];
              $qty_sell += $rep_value['qty_sell'];
            }
            $available = $qty_buy - $qty_sell;
            if ($qty_buy != 0) {
              echo "['$coin_name', $available],";
            }
          }
          ?>
         //end of graph data
        ]);

        var options = {
          title: 'Available Quantity',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>


<?php } // end of else ?>
