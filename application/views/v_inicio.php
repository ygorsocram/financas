          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards>
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">26 New Messages!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">11 New Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">123 New Orders!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div-->

          <!-- Area Chart Example
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>-->

          <div class="card mb-3">
            <div class="card-header">
                      <form id="filtro_transacao" action="<?= base_url("inicio")?>" method="post">
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
          </div>
          <!-- Gráfico de categorias-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Metas</div>
            <div class="card-body">
              <div id="grafico_categoria"></div>
            </div>
        </div>

            <div class="card mb-3">
              <div class="card-header">
            <i class="fas fa-table"></i>
            Extrato Mensal
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
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
        <!-- /.container-fluid -->

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
  </body>

</html>y
