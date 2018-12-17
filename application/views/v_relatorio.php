
  <body id="page-top">
    <div id="wrapper">


      <div id="content-wrapper">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?= base_url('Inicio');?>">Dashboard</a>
            </li>
          </ol>
          <div class="card mb-3">
            <div class="card-header">
                      <form id="filtro_transacao" action="<?= base_url("relatorio")?>" method="post">
                          <table>
                            <tr>
                              <th>
                                <label id="data_inicio_relatorio" class="form-label" for="data_inicio">Data Inicio</label>
                              </th>
                              <th>
                                <input class="form-control proximo_campo" id="data_inicio" name="data_inicio" type="date" value= "<?= $data_inicio; ?>" size="80">
                              </th>
                              <th>
                                <label class="form-label" for="data_fim">&nbsp;&nbsp;Data Fim</label>
                              </th>
                              <th>
                                <input class="form-control proximo_campo" id="data_fim" name="data_fim" type="date" value= "<?= $data_fim; ?>" size="80">
                              </th>
                              <th>
                              &nbsp;
                              <button type="submit" class="btn btn-success btn-sm" id="manusear_despesa"><i class="font-icon fas fa-search" title="Pesquisar"></i></button>
                              </th>
                            </tr>
                          </table>
                      </form>
              </div>

          <!-- Gráfico de categorias-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Categorias</div>
            <div class="card-body">
              <div id="grafico_categoria"></div>
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
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table"></i>
            Extrato
              </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Nome</th>
                      <th>Categoria</th>
                      <th>Conta</th>
                      <th>Entradas</th>
                      <th>Saídas</th>
                    </tr>
                  </thead>
                  <tbody>
      							<?php foreach($transacoes -> result() as $transacoes): ?>
      								<td><?= $transacoes->data_cadastro; ?></td>
      								<td><?= $transacoes->nome; ?></td>
                      <td><?= $transacoes->categoria; ?></td>
                      <td><?= $transacoes->conta; ?></td>
                      <?php if($transacoes->id_tipo == '1'):?>
      								    <td><?= $transacoes->valor; ?></td>
                          <td>0.00</td>
                      <?php else: ?>
      								    <td>0.00</td>
                          <td><?= $transacoes->valor; ?></td>
                      <?php endif ?>
      							</tr>
      							<?php endforeach; ?>
      							</tbody>
                    <tfoot>
                      <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>Somatorio</td>
                          <td><?= $somatorio_entrada; ?></td>
                          <td><?= $somatorio_saida; ?></td>
                      </tr>
                    </tfoot>
                </table>
              </div>
            </div>
        </div>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="<?= base_url('include');?>/#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Page level plugin JavaScript-->
    <script src="<?= base_url('include');?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="<?= base_url('include');?>/js/demo/chart-bar-demo.js"></script>

    <!-- Relatorio de categorias-->
    <script>
        new Morris.Bar({
          element: 'grafico_categoria',
          data: [
          <?php foreach($categorias -> result() as $categorias): ?>
                  {x: '<?= $categorias->nome; ?>', y: <?= $categorias->valor; ?>, a: <?= $categorias->valor_orcamento; ?>},
          <?php endforeach; ?>
          ],
          xkey: 'x',
          ykeys: ['y', 'a'],
          labels: ['Valor Gasto', 'Meta'],
          xLabelAngle: 30
        }).on('click', function(i, row){
          console.log(i, row);
        });
    </script>

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
          max: 3000,
          maxTicksLimit: 5
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
