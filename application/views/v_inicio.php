          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <div class="card mb-3">
            <div class="card-header">
                    <div>
                      <!--input type="hidden" name="data_inicio" id="data_inicio" value= "<?= $data_inicio; ?>">
                      <input type="hidden" name="data_fim" id="data_fim" value= "<?= $data_fim; ?>"-->
                      <a href = "<?= base_url("inicio/decrementa_relatorios/{$data_inicio}/{$data_fim}")?>" id="decrementa"><i class="fas fa-arrow-circle-left"></i></a> 
                       <?=$mes_nome?>
                      <a href = "<?= base_url("inicio/incrementa_relatorios/{$data_inicio}/{$data_fim}")?>" id="incrementa"><i class="fas fa-arrow-circle-right"></i></a> 
                    </div>
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

    <!--Sistema -->
  <script src="<?= base_url('include');?>/js/main.js"></script>
  <!--script src="<?= base_url('include');?>/js/inicio.js"></script-->

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
