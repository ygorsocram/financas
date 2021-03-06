
  <body id="page-top">
    <div id="wrapper">


      <div id="content-wrapper">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('Inicio');?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Relatórios</li>
          </ol>
          <div class="card mb-3">
            <div class="card-header">
                    <div style="text-align: center;">
                      <a href = "<?= base_url("relatorio/decrementa_relatorios/{$data_inicio}/{$data_fim}")?>" id="decrementa"><i class="fas fa-arrow-circle-left"></i></a> 
                       <?=$mes_nome?>
                      <a href = "<?= base_url("relatorio/incrementa_relatorios/{$data_inicio}/{$data_fim}")?>" id="incrementa"><i class="fas fa-arrow-circle-right"></i></a> 
                    </div>
              </div>
          </div>

          <!-- Gráfico de gastos por dia-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Balanço Diário</div>
            <div class="card-body">
              <div id="grafico_balanco_diario"></div>
            </div>
        </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Despesas anuais</div>
                <div class="card-body">
                  <canvas id="despesas_anuais" width="100%" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-pie"></i>
                  Categorias</div>
                <div class="card-body">
                  <canvas id="myPieChart" width="100%" height="100"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:00 PM</div>
              </div>
            </div>
          </div>

            <div class="card mb-3">
              <div class="card-header">
            <i class="fas fa-table"></i>
            Extrato Anual
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Mês referencia</th>
                      <th>Mês</th>
                      <th>Entradas</th>
                      <th>Saídas</th>
                      <th>Sobra</th>
                    </tr>
                  </thead>
                  <tbody>
      							<?php foreach($extrato_anual -> result() as $extratos): ?>
                    <tr>
      								<td><?= $extratos->data_cadastro; ?></td>
      								<td><?= $extratos->data; ?></td>
      								<td><?= $extratos->valor_receita; ?></td>
                      <td><?= $extratos->valor_despesa; ?></td>
                      <td><?= $extratos->valor_sobra; ?></td>
      							</tr>
      							<?php endforeach; ?>
      							</tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="<?= base_url('include');?>/#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

<!-- Morrisjs-->
  <script src="<?= base_url('include');?>/morris/jquery.min.js"></script>
  <script src="<?= base_url('include');?>/morris/raphael-min.js"></script>
  <script src="<?= base_url('include');?>/morris/morris.js"></script>
  <script src="<?= base_url('include');?>/morris/prettify.min.js"></script>
  <script src="<?= base_url('include');?>/morris/lib/example.js"></script>
  <script src="<?= base_url('include');?>/vendor/morrisjs/morris.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?= base_url('include');?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="<?= base_url('include');?>/js/demo/chart-bar-demo.js"></script>

    <!-- Relatorio de Balanco Diário-->
    <script>
      var day_data = [
          <?php foreach($balancos -> result() as $balancos): ?>
                  {"period": "<?= $balancos->data_cadastro?>", "Receita": <?= $balancos->valor_receita; ?>, "Despesa": <?= $balancos->valor_despesa; ?>},
          <?php endforeach; ?>
        ];
      new Morris.Line({
          element: 'grafico_balanco_diario',
          data: day_data,
          xkey: 'period',
          ykeys: ['Receita', 'Despesa'],
          labels: ['Receita', 'Despesa'],
          xLabelAngle: 60
        });
    </script>

    <!-- Relatorio despesas por ano-->
    <script>
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("despesas_anuais");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
            <?php foreach($despesas_ano -> result() as $despesas): ?>
              "<?= $despesas->data; ?>-<?= $despesas->ano; ?>",
              <?php endforeach; ?>
            ],
    datasets: [{
      label: "Valor Gasto",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [
            <?php foreach($despesas_ano -> result() as $despesas): ?>
              "<?= $despesas->valor; ?>",
              <?php endforeach; ?>
            ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          <?php if($somatorio_saida> $somatorio_entrada):?>
            max: <?= $somatorio_saida+100;?>,
          <?php else: ?>
              max: <?= $somatorio_entrada+100; ?>,
          <?php endif ?>
          maxTicksLimit: 12
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
    </script>

    <!-- Gastos por categoria-->
    <script >
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [
          <?php foreach($categorias_valor -> result() as $categorias): ?>
          "<?= $categorias->nome?>",
          <?php endforeach; ?>
            ],
    datasets: [{
      data: [
            <?php foreach($categorias_valor -> result() as $categorias): ?>
            <?= $categorias->valor; ?>,
            <?php endforeach; ?>
            ],
      backgroundColor: [
            <?php foreach($categorias_valor -> result() as $categorias): ?>
            "<?= $categorias->cor; ?>",
            <?php endforeach; ?>
            ],
    }],
  },
});
    </script>
  </body>

</html>
